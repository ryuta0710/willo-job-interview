<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Questions;
use App\Models\Candidate;

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

        $questions = Questions::where([
            'job_id' => $job->id,
        ])->get();
        $count = count($questions);
        // return response()->json($job);
        return view('interview', compact("job", "questions", 'count'));
    }
}
