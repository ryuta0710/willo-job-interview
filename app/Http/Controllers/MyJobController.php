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

        return view('myjob.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $companies = Company::orderBy('name', 'asc')->get();

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
                'salary' => 'required',
                'company_id' => 'required',
                'video_url' => 'required|url',
                'discription' => 'required',
            ]);
            $validator->validate();

            $data = [
                'title' => $request['title'],
                'salary' =>  $request['salary'],
                'company_id' =>  $request['company_id'],
                'video_url' =>  $request['video_url'],
                'discription' =>  $request['discription'],
                'user_id' =>  $user->id,
            ];

            $job_id = Job::create($data)->id;

            return redirect()->route('myjob.create_questions', ['myjob' => $job_id]);
        } else {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'salary' => 'required',
                'company_id' => 'required',
                'discription' => 'required',
                // 'video' => 'required|mimes:mp4,mov,avi',
                'video' => 'required',
            ]);
            $validator->validate();

            $data = [
                'title' => $request['title'],
                'salary' =>  $request['salary'],
                'company_id' =>  $request['company_id'],
                'discription' =>  $request['discription'],
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
    public function show(string $id)
    {
        return view('myjob.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $companies = Company::orderBy('name', 'asc')->get();
        $job = Job::where(['id' => $id])->first();
        if(empty($job))
            return redirect()->route("myjob.create");
        return view('myjob.edit', compact("companies", "job"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function person(string $myjob, string $user_id)
    {
        return view('myjob.person');
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
            $job['mail_invite_id'] = $request['mail_invite_id'];
            $job['mail_success_id'] = $request['mail_success_id'];
            $job['mail_reminder_id'] = $request['mail_reminder_id'];
            $job['sms_invite_id'] = $request['sms_invite_id'];
            $job['sms_reminder_id'] = $request['sms_reminder_id'];
            
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
            return view("myjob.publish", compact("myjob", "invited_users"));
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

            $length = 50;
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';

            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }

            $job['limit_date'] = $request['limit_date'];
            $job['redirect_url'] = $request['redirect_url'];
            $job['language'] = $request['language'];
            // $job['isTip'] = $request['isTip'];
            // $job['isFollow'] = $request['isFollow'];
            $job['url'] = $randomString;
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
}
