<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\Questions;

class OtherController extends Controller
{
    public function invitePeople(Request $request, string $myjob) {
        $user = Auth::user();
        $job = Job::where([
            'id' => $myjob,
            'user_id' => $user->id,
        ])->first();
        if(!empty($job)){
            $url = $job['url'];
        return view('invite-people', compact("url"));
        }
    }

    public function getJobList() {
        return view('jobList');
    }

    public function getJobDetail() {
        return view('jobDetail');
    }

    public function contact() {
        return view('contact');
    }

    // public function interview(Request $request, string $url) {
    //     $job = Job::where([
    //         'url' => $url,
    //     ])
    //     ->first();
    //     if(empty($job)){
    //         return redirect("/");
    //     }

    //     $questions = Questions::where([
    //         'job_id' => $job->id,
    //     ])->get();
    //     $count = count($questions);
    //     return view('interview', compact("job", "questions", 'count'));
    // }
}
