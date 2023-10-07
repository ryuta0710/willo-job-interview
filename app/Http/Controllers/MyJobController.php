<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use App\Models\Questions;
use App\Models\InvitedUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\HTTP\Response;
use App\Models\Message;
use App\Models\Candidate;
use App\Models\Answer;
use App\Models\Activity;
use Illuminate\Http\Request;

class MyJobController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $jobs = Job::join('companies', 'jobs.company_id', '=', 'companies.id')
            ->join('users', 'jobs.user_id', '=', 'users.id')
            ->where('jobs.user_id', $user->id)
            ->orderBy('jobs.created_at', 'desc')
            ->select('jobs.*', 'companies.name as company_name', 'users.name as user_name', 'users.email as email')
            ->get();
        $companies = Company::where(['owner' => $user->id])->orderBy('name', 'asc')->get();
        $owners = InvitedUsers::join('users', 'invited_users.inviter', '=', 'users.email')
        ->where(['invited_users.inviter' => $user->email])
        ->where('invited_users.user_id', '!=', 0)
        ->select("users.name as name", "invited_users.*")
        ->get();
        $name = $user->name;
        return view('myjob.index', compact("jobs",'companies', 'owners', 'name'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $title = $request->input('title');
        $company = $request->input('company');
        $owner = $request->input('owner');
        $status = $request->input('status');

        $jobs = Job::join('companies', 'jobs.company_id', '=', 'companies.id')
            ->join('users', 'jobs.user_id', '=', 'users.id')
            ->where('jobs.user_id', $user->id)
            ->when($title, function ($query) use ($title) {
                return $query->where('jobs.title', 'LIKE', '%' . $title . '%');
            })
            ->when($company, function ($query) use ($company) {
                return $query->where('companies.name', 'LIKE', '%' . $company . '%');
            })
            ->when($owner, function ($query) use ($owner) {
                return $query->where('users.name', 'LIKE', '%' . $owner . '%');
            })
            ->when($status, function ($query) use ($status) {
                return $query->where('jobs.status', $status);
            })
            ->orderBy('jobs.created_at', 'desc')
            ->select('jobs.*', 'companies.name as company_name', 'users.name as user_name', 'users.email as email')
            ->get();

        return response()->json($jobs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $companies = Company::where(['user_id' => $user->id])->orderBy('name', 'asc')->get();

        return view('myjob.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $job_id = 0;

        if (!$request->has('state_toggle')) {

            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'salary' => 'required|integer',
                'company_id' => 'required',
                'video_url' => 'required|url',
                'description' => 'required',
            ]);
            $validator->validate();

            $company = Company::where([
                'id' => intval($request['company_id']),
            ])->first();

            if (empty($company)) {
                return response('', 400);
            }
            $data = [
                'title' => $request['title'],
                'salary' =>  intval($request['salary']),
                'company_id' =>  $request['company_id'],
                'video_url' =>  $request['video_url'],
                'description' =>  $request['description'],
                'field_id' =>  $company->field,
                'user_id' =>  $user->id,
            ];

            $job_id = Job::create($data)->id;

            return redirect()->route('myjob.create_questions', ['myjob' => $job_id]);
        } else {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'salary' => 'required|integer',
                'company_id' => 'required',
                'description' => 'required',
                // 'video' => 'required|mimes:mp4,mov,avi',
                'video' => 'required',
            ]);
            $validator->validate();

            $company = Company::where([
                'id' => intval($request['company_id']),
            ])->first();

            if (empty($company)) {
                return response('', 400);
            }
            $data = [
                'title' => $request['title'],
                'salary' =>  intval($request['salary']),
                'company_id' =>  $request['company_id'],
                'description' =>  $request['description'],
                'field_id' =>  $company->field,
                'user_id' =>  $user->id,
            ];


            if ($request->hasFile('video')) {

                $video = $request->file('video');
                $fileName = time() . '.' . $video->getClientOriginalExtension();

                $video->move(public_path('/assets/upload/job_intro_video/'), $fileName);
                $data['video_url'] = asset('/assets/upload/job_intro_video/' . $fileName);;
            }

            $data['user_id'] = $user->id;

            $job_id = Job::create($data)->id;

            return redirect()->route('myjob.create_questions', ['myjob' => $job_id]);
        }

        return redirect()->route('myjob.create_questions', ['myjob' => $job_id,]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $myjob)
    {
        $job_id = $myjob;
        $job = Job::where([
            'id' => $job_id,
        ])->first();

        $all_count = Candidate::where([
            'job_id' => $job_id,
        ])->count();

        $all_responded = Candidate::where('status', '!=', 'init')
            ->count();

        $reviews = Candidate::where([
            'job_id' => $job_id,
            'status' => 'responsed',
        ])
            ->get();

        $accepts = Candidate::where([
            'job_id' => $job_id,
            'status' => 'accepted',
        ])->get();

        $rejects = Candidate::where([
            'job_id' => $job_id,
            'status' => 'rejected',
        ])->get();

        $per1 = 0;
        $per2 = 0;
        $per3 = 0;
        $per4 = 0;
        $per5 = 0;
        if ($all_count != 0) {
            // $per1 = count($accepts)/$max * 100;
            $per2 = count($reviews) / $all_count * 100;
            $per3 = count($accepts) / $all_count * 100;
            $per4 = count($rejects) / $all_count * 100;
            $per5 = $all_responded / $all_count * 100;
        }


        return view('myjob.show', compact(
            'job_id',
            'job',
            'reviews',
            'accepts',
            'rejects',
            'all_count',
            'per1',
            'per2',
            'per3',
            'per4',
            'per5',
            'all_responded',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $companies = Company::orderBy('name', 'asc')->get();
        $job = Job::where(['id' => $id, 'user_id' => $user->id])->first();
        if (empty($job))
            return redirect()->route("myjob.create");
        return view('myjob.edit', compact("companies", "job"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $job = Job::where(['id' => $id, 'user_id' => $user->id])->first();

        if (empty($job))
            return redirect()->route('myjob.create');


        if (!$request->has('state_toggle')) {

            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'salary' => 'required|integer',
                'company_id' => 'required',
                'video_url' => 'required|url',
                'description' => 'required',
            ]);
            $validator->validate();
            $job['title'] = $request['title'];
            $job['salary'] = intval($request['salary']);
            $job['company_id'] = $request['company_id'];
            $job['video_url'] = $request['video_url'];
            $job['description'] = $request['description'];

            $job->save();

            return redirect()->route('myjob.create_questions', ['myjob' => $id]);
        } else {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'salary' => 'required',
                'company_id' => 'required',
                'description' => 'required',
                // 'video' => 'required|mimes:mp4,mov,avi',
                'video' => 'required',
            ]);
            $validator->validate();

            $validator->validate();
            $job['title'] = $request['title'];
            $job['salary'] = intval($request['salary']);
            $job['company_id'] = $request['company_id'];
            $job['description'] = $request['description'];


            if ($request->hasFile('video')) {

                $video = $request->file('video');
                $fileName = time() . '.' . $video->getClientOriginalExtension();

                $video->move(public_path('/assets/upload/job_intro_video/'), $fileName);
                $job['video_url'] = asset('/assets/upload/job_intro_video/' . $fileName);;
            }
            $job->save();

            return redirect()->route('myjob.create_questions', ['myjob' => $id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $myjob)
    {
        $user_id = Auth::user()->id;
        $job = Job::where(['id' => $myjob, 'user_id' => $user_id])->first();
        if (!empty($job)) {
            $job->delete();
            return response()->json([
                'status' => 'success'
            ], Response::HTTP_OK);
        }
        return response()->json([
            'status' => 'failed',
            'message' => '操作が失敗しました',
        ], Response::HTTP_OK);
    }

    public function person(string $myjob, string $user_id)
    {
        $job = Job::join('companies', 'jobs.company_id', '=', 'companies.id')
            ->where([
                'jobs.id' => $myjob,
            ])->select('jobs.*', 'companies.name as company_name')
            ->first();
        $candidate = Candidate::where([
            'id' => $user_id,
        ])->first();

        $status = $candidate->status;
        $candidates_for = Candidate::where([
            'status' => $status,
            'job_id' => $candidate->job_id,
        ])
        ->orderby('id', 'asc')
        ->get();
        $next = 0;
        $prev = 0;
        $len = count($candidates_for);
        for ($i = 0; $i < $len; $i++) {
            if ($candidate->id == $candidates_for[$i]->id) {
                if($i != 0){
                    $prev = $candidates_for[$i-1]->id;
                }
                if ($i < $len - 1) {
                    $next = $candidates_for[$i+1]->id;
                }
            }
        }


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
        return view('myjob.person', compact(
            'job',
            'candidate',
            'count',
            'questions',
            'answers',
            'candidates_for',
            'next',
            'prev',
        ));
    }

    public function create_questions(string $myjob)
    {
        $job = Job::where(['id' => $myjob])->get();
        $user_id = Auth::user()->id;
        if (count($job) != 1)
            return redirect()->back();

        $questions = Questions::where([
            'job_id' => intval($myjob),
            'user_id' => intval($user_id),
        ])->orderBy('question_no', 'asc')->get();
        // $questions = [];
        return view('myjob.create_questions', compact('myjob', 'questions'));
    }

    public function copy(string $myjob)
    {
        $user_id = Auth::user()->id;
        $job = Job::where(['id' => $myjob, 'user_id' => $user_id])->first();

        if (empty($job))
            return redirect()->back();
        $new_job = [];
        $new_job['title'] = "コピー ".$job['title'];
        $new_job['salary'] = $job['salary'];
        $new_job['company_id'] = $job['company_id'];
        $new_job['description'] = $job['description'];
        $new_job['video_url'] = $job['video_url'];
        $new_job['user_id'] = $job['user_id'];
        $new_job['field_id'] = $job['field_id'];
        $new_job['limit_date'] = $job['limit_date'];
        $new_job['mail_invite_id'] = intval($job['mail_invite_id']);
        $new_job['mail_success_id'] = intval($job['mail_success_id']);
        $new_job['mail_reminder_id'] = intval($job['mail_reminder_id']);
        $new_job['sms_invite_id'] = intval($job['sms_invite_id']);
        $new_job['sms_reminder_id'] = intval($job['sms_reminder_id']);
        $new_job['status'] = $job['status'];
        $new_job['url'] = $this->randomUrl();

        $job_id = Job::create($new_job)->id;

        $questions = Questions::where([
            'job_id' => intval($myjob),
            'user_id' => intval($user_id),
        ])->orderBy('question_no', 'asc')->get();

        foreach ($questions as $question) {
            $data = [
                'type' => $question['type'],
                'content' => $question['content'],
                'retake' => $question['retake'],
                'answer_time' => $question['answer_time'],
                'limit_type' => $question['limit_type'],
                'max' => $question['max'],
                'thinking_hour' => $question['thinking_hour'],
                'thinking_minute' => $question['thinking_minute'],
                'question_no' => $question['question_no'],
                'job_id' => $job_id,
                'user_id' => $user_id,
            ];
            Questions::create($data);
        }

        return response()->json([
            'status' => 'success',
        ], Response::HTTP_OK);
    }

    public function store_questions(Request $request, string $myjob)
    {
        $length = $request->length;
        $user = Auth::user();
        $job = Job::where([
            'id' => $myjob,
            'user_id' => $user->id,
        ])->get();

        if ($length != 0 || count($job) > 0) {
            //early exist data is deleted
            Questions::where([
                'job_id' => intval($myjob),
                'user_id' => intval($user->id),
            ])->delete();

            $arr = $request->data;
            foreach ($arr as $question) {
                $data = [
                    'type' => $question['type'],
                    'content' => $question['content'],
                    'retake' => $question['retake'],
                    'answer_time' => $question['answer_time'],
                    'limit_type' => $question['limit_type'],
                    'max' => $question['max'],
                    'thinking_hour' => $question['thinking_hour'],
                    'thinking_minute' => $question['thinking_minute'],
                    'question_no' => $question['question_no'],
                    'job_id' => $myjob,
                    'user_id' => $user->id,
                ];
                // return response()->json($data);
                Questions::create($data);
            }
            return redirect()->route("myjob.select_messages", ['myjob' => $myjob]);

            // return response()->json([
            //     'status' => 'success',
            //     'message' => '操作が成功しました',
            // ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => '操作が失敗しました。'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function select_messages(Request $request, string $myjob)
    {
        $user_id = Auth::user()->id;
        $jobs = Job::where([
            'id' => $myjob,
            'user_id' => $user_id,
        ])
            ->get();
        $messages = Message::where([
            'writer' => Auth::user()->email,
        ])
            ->orWhere([
                'editable' => 0,
            ])->get()
            ->toArray();

        if (count($jobs) == 1 && count($messages) > 0) {
            $mail_invites = array_filter($messages, function ($item) {
                return $item['type'] == "email" && $item['trigger'] == "invite";
            });
            $mail_success = array_filter($messages, function ($item) {
                return $item['type'] == "email" && $item['trigger'] == "success";
            });
            $mail_reminder = array_filter($messages, function ($item) {
                return $item['type'] == "email" && $item['trigger'] == "reminder";
            });
            $sms_invites = array_filter($messages, function ($item) {
                return $item['type'] == "email" && $item['trigger'] == "invite";
            });
            $sms_reminders = array_filter($messages, function ($item) {
                return $item['type'] == "email" && $item['trigger'] == "reminder";
            });
            //early exist data is deleted
            return view("myjob.select_message", compact(
                "mail_invites",
                "mail_success",
                "mail_reminder",
                "sms_invites",
                "sms_reminders",
                "myjob"
            ));
        } else {
            return redirect()->back();
        }
    }

    public function store_messages(Request $request, string $myjob)
    {
        $user = Auth::user();
        $job = Job::where([
            'id' => $myjob,
            'user_id' => $user->id,
        ])->first();

        if (!empty($job)) {
            $job['mail_invite_id'] = intval($request['mail_invite_id']);
            $job['mail_success_id'] = intval($request['mail_success_id']);
            $job['mail_reminder_id'] = intval($request['mail_reminder_id']);
            $job['sms_invite_id'] = intval($request['sms_invite_id']);
            $job['sms_reminder_id'] = intval($request['sms_reminder_id']);

            $job->save();
            return response()->json([
                'status' => "success",
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => '操作が失敗しました。'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function publish(Request $request, string $myjob)
    {
        $user_id = Auth::user()->id;
        $job = Job::where([
            'id' => $myjob,
            'user_id' => $user_id,
        ])
            ->first();

        if (!empty($job)) {

            $user = Auth::user();
            $invited_users = InvitedUsers::where('inviter', $user->email)->get();
            //early exist data is deleted
            return view("myjob.publish", compact("myjob", "invited_users", "job"));
        } else {
            return redirect()->back();
        }
    }

    public function store_publish(Request $request, string $myjob)
    {
        $user = Auth::user();
        $job = Job::where([
            'id' => $myjob,
            'user_id' => $user->id,
        ])->first();

        if (!empty($job)) {
            $randomString = $this->randomUrl();

            $job['limit_date'] = $request['limit_date'];
            $job['redirect_url'] = $request['redirect_url'];
            $job['language'] = $request['language'];
            // $job['isTip'] = $request['isTip'];
            // $job['isFollow'] = $request['isFollow'];
            $job['url'] = $randomString;
            $job['status'] = 'live';
            $job->save();
            return response()->json([
                'status' => "success",
                'url' => $randomString,
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => '操作が失敗しました。'
            ], Response::HTTP_BAD_REQUEST);
        }
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

    public function add_note(Request $request, string $candidate_id)
    {
        $user = Auth::user();
        $candidate = Candidate::where([
            'id' => $candidate_id,
        ])->first();
        if (empty($candidate)) {
            return response(['status' => 'failed', 'message' => '操作が失敗しました'], 400);
        }
        Activity::create([
            'candidate_id' => $candidate->id,
            'name' => $user->name,
            'content' => $request['note'],
            'type' => 'note',
        ]);
        return response(['status' => 'success']);
    }

    public function candidate_status_change(Request $request, string $candidate_id)
    {
        $user = Auth::user();
        $candidate = Candidate::where([
            'id' => $candidate_id,
        ])->first();
        if (empty($candidate)) {
            return response(['status' => 'failed', 'message' => '操作が失敗しました'], 400);
        }
        $status = $request->status;
        if($status == "accepted"){
            $candidate['status'] = "accepted";
            $candidate->save();
            return response(['status' => 'success']);
        }
        if($status == "rejected"){
            $candidate['status'] = "rejected";
            $candidate->save();
            return response(['status' => 'success']);
        }
        return response(['status' => 'failed', 'message' => '操作が失敗しました'], 400);
    }

    public function candidate_review_change(Request $request, int $candidate_id)
    {
        $user = Auth::user();
        $candidate = Candidate::where([
            'id' => 5,
        ])->first();
        if (empty($candidate)) {
            return response()->json(['status' => 'failed', 'message' => '操作が失敗しました'], Response::HTTP_BAD_REQUEST);
        }
        $review = intval($request['review']);
        if(!$review){
            return response()->json(['status' => 'failed', 'message' => '操作が失敗しました'], Response::HTTP_BAD_REQUEST);
        }
        $candidate['review'] = $review;
        $candidate->save();
        return response(['status' => 'success']);
    }
}
