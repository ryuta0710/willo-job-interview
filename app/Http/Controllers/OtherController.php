<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

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

    public function interview() {
        return view('test');
    }
}
