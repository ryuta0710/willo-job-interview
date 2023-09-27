<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Questions;
use App\Models\Candidate;
use App\Models\Message;
use App\Models\Answer;
use Illuminate\Support\Facades\Validator;
use Illuminate\HTTP\Response;

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
        return view('interview', compact("job", "questions", 'count', 'message', 'url'));
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
        return view('answer', compact("question", "is_last", "count", "candidate_url", "next_no", "answer_url"));
    }

    public function save_text (Request $request, string $url){
        
        $validator = Validator::make($request->all(), [
            'content' => 'required',
            'count' => 'required',
            'q_no' => 'required|integer',
        ]);
        $validator->validate();

        // $candidate = Candidate::where([
        //     'url' => $url,
        // ])->first();
        // //check if the cnadidate is empty
        // $job_id = $candidate->job_id;
        // $job = Job::where([
        //     'id' => $job_id,
        // ])->first();
        // if(empty($candidate) || empty($job)){
        //     return response()->json([
        //         'message' => 'リクエストが正確ではありません'
        //     ], Response::HTTP_BAD_REQUEST);
        // }

        // //check if the cnadidate is empty
        // $question = Questions::where([
        //     'question_no' => intval($request['q_no']),
        //     'job_id' => $job->id,
        // ]);
        // if(empty($question)){
        //     return response()->json([
        //         'message' => 'There isn\'t the question.'
        //     ]);
        // }
        //check if the answer exists
        $answer = Answer::where([
            'url' => $url,
        ])->first();
        if(empty($answer)){
            return response(['status' => 'failed',
                'message' => 'Failed save',
            ]);
        }
        // return $request['content'];  
        $answer['content'] = $request['content'];
        $answer['count'] = intval($request['count']);
        $answer->save();

        return response()->json([], Response::HTTP_OK);
    }

    public function create_answer (Request $request, string $url){
        
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
        if(empty($candidate) || empty($job)){
            return response()->json([
                'message' => 'リクエストが正確ではありません'
            ], Response::HTTP_BAD_REQUEST);
        }

        //check if the cnadidate is empty
        $question = Questions::where([
            'question_no' => intval($request['q_no']),
            'job_id' => $job->id,
        ])->first();
        if(empty($question)){
            return response()->json([
                'message' => 'There isn\'t the question.'
            ]);
        }
        //check if the answer exists
        $answer = Answer::where([
            'candidate_id' => $candidate->id,
        ])->first();
        return $answer;
        if(empty($answer)){
            $ran_url = $this->randomUrl();
            $new_answer = Answer::create([
                'job_id' => $job->id,
                'candidate_id' => $candidate->id,
                'question_type' => $question->type,
                'question_id' => $question->id,
                'url' => $ran_url,
            ]);
            return response(['status' => 'succes', 'url' => route('interview.answer', ['candidate_url' => $url, 'answer_url'=> $new_answer->url]) ]);
        }else{
            return response(['status' => 'succes', 'url' => route('interview.answer', ['candidate_url' => $url, 'answer_url'=> $answer->url]) ]);
        }

        return response(['message' => 'Failed creating answer.'], Response::HTTP_BAD_REQUEST);
    }
    
    protected function randomUrl()
    {
        $length = 30;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}
