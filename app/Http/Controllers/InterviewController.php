<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Questions;

class InterviewController extends Controller
{
    public function index(Request $request, string $url) {
        $job = Job::where([
            'url' => $url,
        ])
        ->first();
        if(empty($job)){
            return redirect("/");
        }

        $questions = Questions::where([
            'job_id' => $job->id,
        ])->get();
        $count = count($questions);
        return view('interview', compact("job", "questions", 'count'));
    }
}
