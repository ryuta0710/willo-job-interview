<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Questions;
use App\Models\Candidate;
use App\Models\Message;
use App\Models\Answer;
use App\Models\Booking;
use App\Models\Activity;
use App\Models\CandidateShare;
use Illuminate\Support\Facades\Validator;
use Illuminate\HTTP\Response;
use Illuminate\Support\Facades\Auth;

class InterviewController extends Controller
{

    public function index(Request $request, string $url)
    {
        $candidate = Candidate::where([
            'url' => $url,
        ])
            ->first();
        if (empty($candidate)) {
            return redirect("/");
        }
        $job_url = $candidate->job_url;

        $job = Job::where([
            'url' => $job_url,
        ])
            ->first();
        if (empty($job)) {
            return redirect("/");
        }

        $message = Message::where([
            'id' => $job->mail_invite_id
        ])->first();

        $questions = Questions::where([
            'job_id' => $job->id,
        ])->get();
        $count = count($questions);
        // return response()->json($job);
        return view('interview.index', compact("job", "questions", 'count', 'message', 'url'));
    }
    //answer show
    public function answer(Request $request, string $candidate_url, string $answer_url)
    {
        $candidate = Candidate::where([
            'url' => $candidate_url,
        ])
            ->first();
        if (empty($candidate)) {
            return redirect()->back();
        }
        //check if the answer exist
        $answer = Answer::where([
            'url' => $answer_url,
        ])
            ->first();
        if (empty($answer)) {
            return redirect()->back();
        }
        //check if the question exist
        $question = Questions::where([
            'id' => $answer->question_id,
        ])
            ->first();
        if (empty($question)) {
            return redirect()->back();
        }
        //check if the questions is last
        $count = Questions::where([
            'job_id' => $question->job_id,
        ])
            ->count();
        $is_last = false;
        if ($count == $question->question_no) {
            $is_last = true;
        }
        //generate a new answer
        $next_no = $question->question_no + 1;

        // return response()->json($question);
        return view('interview.answer', compact("question", "is_last", "count", "candidate_url", "next_no", "answer_url"));
    }
    //show all answer
    public function confirm(Request $request, string $url)
    {
        $candidate = Candidate::where([
            'url' => $url,
        ])
            ->first();
        if (empty($candidate)) {
            return redirect()->back();
        }
        //fetch the answers for the candidate
        $answers = Answer::where([
            'candidate_id' => $candidate->id,
        ])->orderby('question_id', 'asc')
            ->get();
        if (count($answers) == 0) {
            return redirect()->back();
        }
        //fetch questions
        $questions = Questions::where([
            'job_id' => $candidate->job_id,
        ])->orderby('question_no', 'asc')
            ->get();
        if (count($questions) == 0) {
            return redirect()->back();
        }
        //check if the count of questions and answers is equal
        $count = count($questions);
        if (count($questions) != count($answers)) {
            return redirect()->back();
        }
        // return response()->json($question);
        return view('interview.confirm', compact("questions", "answers", "url", "count"));
    }
    //show all answer
    public function booking(Request $request, string $url)
    {
        $candidate = Candidate::where([
            'url' => $url,
        ])
            ->first();
        if (empty($candidate)) {
            return redirect()->back();
        }
        $job = Job::where([
            'id' => $candidate->job_id,
        ])->first();
        $redirect_url = $job->redirect_url;
        return view('interview.booking', compact('url', 'redirect_url'));
    }

    public function save_booking(Request $request, string $url)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'tel' => 'required',
            'is_book' => 'required',
            'date' => 'required',
        ]);
        $validator->validate();
        $candidate = Candidate::where([
            'url' => $url,
        ])->first();

        if (empty($candidate)) {
            return redirect()->back();
        }
        $candidate['name'] = $request['name'];
        $candidate['email'] = $request['email'];
        $candidate['tel'] = $request['tel'];
        $timestamp = time();
        $candidate['response_at'] = date("Y/m/d", $timestamp);
        $candidate['time'] = date("H:i:s", $timestamp);
        $candidate['status'] = 'responsed';
        $candidate['share_link'] = $this->randomUrl();
        $candidate['share_allow'] = 1;
        $candidate->save();

        $activity = [
            'candidate_id' => $candidate->id,
            'content' => '応答を受信しました',
            'type' => 'reponse',
        ];
        Activity::create($activity);

        $job = Job::where([
            'id' => $candidate->job_id,
        ])->first();
        $response_count = intval($job->responses_count) + 1;
        $job['responses_count'] = $response_count;
        $job->save();

        Booking::where([
            'candidate_id' => $candidate->id,
        ])->delete();

        if ($request['is_book']) {
            $schedules = $request['schedules'];

            foreach ($schedules as $item) {
                if ($item['day'] && $item['time']) {
                    Booking::create([
                        'day' => "" . $item['day'],
                        'time' => "" . $item['time'],
                        'candidate_id' => $candidate->id,
                    ]);
                }
            }
        }
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function save_text(Request $request, string $url)
    {

        $validator = Validator::make($request->all(), [
            'content' => 'required',
            'count' => 'required',
            'q_no' => 'required|integer',
        ]);
        $validator->validate();

        $answer = Answer::where([
            'url' => $url,
        ])->first();
        if (empty($answer)) {
            return response([
                'status' => 'failed',
                'message' => 'Failed save',
            ]);
        }
        // return $request['content'];  
        $answer['content'] = $request['content'];
        $answer['count'] = intval($request['count']);
        $answer->save();

        return response()->json([], Response::HTTP_OK);
    }

    public function save_file(Request $request, string $url)
    {

        $validator = Validator::make($request->all(), [
            'file' => 'required|file',
            'count' => 'required',
            'q_no' => 'required|integer',
        ]);
        $validator->validate();

        $file = $request->file('file');
        $originalfilename = $file->getClientOriginalName();
        $fileName = time() . '.' . $file->getClientOriginalExtension();

        $file->move(public_path('/assets/upload/answer/'), $fileName);
        $file_url = asset('/assets/upload/answer/' . $fileName);

        $answer = Answer::where([
            'url' => $url,
        ])->first();
        if (empty($answer)) {
            return response([
                'status' => 'failed',
                'message' => 'Failed save. The url is incorrect',
            ]);
        }
        $answer['count'] = intval($request['count']);
        $answer['rc_url'] = $file_url;
        $answer['content'] = $originalfilename;
        $answer->save();

        return response()->json([], Response::HTTP_OK);
    }

    public function create_answer(Request $request, string $url)
    {

        $validator = Validator::make($request->all(), [
            'q_no' => 'required|integer',
        ]);
        $validator->validate();

        $candidate = Candidate::where([
            'url' => $url,
        ])->first();
        //check if the cnadidate is empty
        $job_id = $candidate->job_id;
        $job = Job::where([
            'id' => $job_id,
        ])->first();
        if (empty($candidate) || empty($job)) {
            return response()->json([
                'message' => 'リクエストが正確ではありません'
            ], Response::HTTP_BAD_REQUEST);
        }

        //check if the cnadidate is empty
        $question = Questions::where([
            'question_no' => intval($request['q_no']),
            'job_id' => $job->id,
        ])->first();
        if (empty($question)) {
            return response()->json([
                'message' => 'There isn\'t the question.'
            ]);
        }
        //check if the answer exists
        $answer = Answer::where([
            'candidate_id' => $candidate->id,
            'question_id' => $question->id,
        ])->first();
        if (empty($answer)) {
            $ran_url = $this->randomUrl();
            $new_answer = Answer::create([
                'job_id' => $job->id,
                'candidate_id' => $candidate->id,
                'question_type' => $question->type,
                'question_id' => $question->id,
                'question_content' => $question->content,
                'url' => $ran_url,
            ]);
            return response(['status' => 'succes', 'url' => route('interview.answer', ['candidate_url' => $url, 'answer_url' => $new_answer->url])]);
        } else {
            return response(['status' => 'succes', 'url' => route('interview.answer', ['candidate_url' => $url, 'answer_url' => $answer->url])]);
        }

        return response(['message' => 'Failed creating answer.'], Response::HTTP_BAD_REQUEST);
    }

    protected function randomUrl()
    {
        $length = 60;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public function status(Request $request, string $id)
    {
        $interview = Job::where(['id' => $id])
            ->first();
        if (empty($interview)) {
            return redirect()->back();
        }
        $status = $request['status'];
        if ($interview['status'] == "live" && $status == "closed") {
            $interview['status'] = "closed";
            $interview->save();
        } else if ($interview['status'] == "closed" && $status == "live") {
            $interview['status'] = "live";
            $interview->save();
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'リクエストが正確ではありません',
            ], Response::HTTP_BAD_REQUEST);
        }
        return response()->json([
            'status' => 'success',
            'message' => '操作が成功しました',
        ]);
    }

    public function search(Request $request, int $id)
    {
        $user = Auth::user();
        $rate = $request->input('rate');
        $keyword = $request->input('keyword');

        $review = Candidate::where('job_id', $id)
            ->where('user_id', $user->id)
            ->where('status', 'responsed')
            ->when($keyword, function ($query) use ($keyword) {
                return $query->where('name', 'LIKE', '%' . $keyword . '%');
            })
            ->when($rate, function ($query) use ($rate) {
                return $query->where('review', $rate);
            })
            ->get();

        $accepted = Candidate::where('job_id', $id)
            ->where('user_id', $user->id)
            ->where('status', 'accepted')
            ->when($keyword, function ($query) use ($keyword) {
                return $query->where('name', 'LIKE', '%' . $keyword . '%');
            })
            ->when($rate, function ($query) use ($rate) {
                return $query->where('review', $rate);
            })
            ->get();

        $rejected = Candidate::where('job_id', $id)
            ->where('user_id', $user->id)
            ->where('status', 'rejected')
            ->when($keyword, function ($query) use ($keyword) {
                return $query->where('name', 'LIKE', '%' . $keyword . '%');
            })
            ->when($rate, function ($query) use ($rate) {
                return $query->where('review', $rate);
            })
            ->get();

        return response()->json([
            'review' => $review,
            'accepted' => $accepted,
            'rejected' => $rejected,
        ]);
    }

    public function interview_closed()
    {
        return view('error.interview-closed');
    }

    public function candidate_remove(string $candidate_id)
    {
        $candidate = Candidate::find($candidate_id);
        if (empty($candidate)) {
            return response()->json(['status' => 'failed'], Response::HTTP_BAD_REQUEST);
        }
        $answers = Answer::where('candidate_id', $candidate_id)
            ->get();
        foreach ($answers as $ans) {
            if ($ans->rc_url) {
                $publicPath = str_replace(url('/'), '', $ans->rc_url);
                $publicPath = public_path($publicPath);
                if (file_exists($publicPath)) {
                    unlink($publicPath);
                }
            }
        }
        Answer::where('candidate_id', $candidate_id)
        ->delete();
        $candidate->delete();
        return response()->json(['status' => 'success']);
    }
}
