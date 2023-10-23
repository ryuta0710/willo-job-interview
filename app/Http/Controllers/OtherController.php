<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\Field;
use App\Models\Candidate;
use App\Models\Questions;
use App\Models\Answer;
use App\Models\Company;
use App\Models\User;
use Illuminate\HTTP\Response;

class OtherController extends Controller
{

    public function getJobList(Request $request)
    {
        $jobs = Job::join('companies', 'jobs.company_id', '=', 'companies.id')
            ->join('fields', 'jobs.field_id', '=', 'fields.id')
            ->where([
                'status' => 'live',
            ])
            ->orderby('updated_at', 'desc')
            ->select('jobs.*', 'companies.email as email', 'fields.name as field')
            ->take(20)
            ->get();

        $fields = Field::query()->orderby('name', 'asc')->get()->toArray();

        $fields = array_slice($fields, 0, 6);

        return view('jobList', compact('fields', 'jobs'));
    }

    public function fetchJobs(Request $request)
    {
        $request = $request->toArray();
        $search_key = $request['search_key'];
        $salary_min = intval($request['salary_min']);
        $salary_max = intval($request['salary_max']);
        if ($salary_max == 0) {
            $salary_max = PHP_INT_MAX;
        }
        $field_id = intval($request['field_id']);
        $page_no = intval($request['page_no']);
        $offset = 20 * $page_no;

        $search_key = $request['search_key'];

        $jobs = [];
        if ($field_id > 0) {
            $jobs = Job::join('companies', 'jobs.company_id', '=', 'companies.id')
                ->join('fields', 'jobs.field_id', '=', 'fields.id')
                ->where([
                    'status' => 'live',
                    'field_id' => $field_id,
                ])
                ->where('description', 'LIKE', '%' . $search_key . '%')
                ->whereBetween('salary', [$salary_min, $salary_max])
                ->orderby('updated_at', 'desc')
                ->select('jobs.*', 'companies.email as email', 'fields.name as field')
                ->skip($offset)
                ->take(20)
                ->get();
        } else {
            $jobs = Job::join('companies', 'jobs.company_id', '=', 'companies.id')
                ->join('fields', 'jobs.field_id', '=', 'fields.id')
                ->where([
                    'status' => 'live',
                ])
                ->where('description', 'LIKE', '%' . $search_key . '%')
                ->whereBetween('salary', [$salary_min, $salary_max])
                ->orderby('updated_at', 'desc')
                ->select('jobs.*', 'companies.email as email', 'fields.name as field')
                ->skip($offset)
                ->take(20)
                ->get();
        }

        return response()->json([
            'status' => 'success',
            'data' => $jobs,
            'request' => $request,
        ]);
    }

    public function getJobDetail(Request $request, string $url)
    {
        $job = Job::where([
            'url' => $url,
        ])->join('companies', 'jobs.company_id', '=', 'companies.id')
            ->leftJoin('fields', 'jobs.field_id', '=', 'fields.id')
            ->select('jobs.*', 'fields.name as field', 'companies.email as email', 'companies.website as website', 'companies.name as company_name')
            ->first();
        if(empty($job)){
            return redirect()->route("getJobList");
        }
        return view('jobDetail', compact('job'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function invitePeople(string $myjob)
    {
        $job = Job::find($myjob);
        $company = Company::find($job->company_id);
        return view("invite-people", compact('job', 'company'));
    }

    public function redirect_interview(string $url)
    {
        $job = Job::where([
            'url' => $url,
        ])->first();
        //check if the job is empty
        if (empty($job)) {
            return redirect()->back();
        }
        if($job->status == "closed"){
            return redirect()->route('interview.interview_closed');
        }
        if($job->limit_date){
            $limit_date = date("Y/m/d", strtotime($job->limit_date));
            $now = date('Y/m/d');
            if($now > $limit_date){
                return redirect()->route('interview.interview_closed');
            }
        }
        //generate a random url
        $candidate_url = $this->randomUrl();
        //create candidate
        // $started = intval($job['started_count']) + 1;
        // $job['started_count'] = $started;
        $candidate = Candidate::create([
            'job_id' => $job->id,
            'user_id' => $job->user_id,
            'job_url' => $job->url,
            'company_id' => $job->company_id,
            'url' => $candidate_url,
        ]);
        $job->save();
        $activity = [
            'candidate_id' => $candidate->id,
            'content' => 'インタビューページにアクセスしました',
            'type' => 'visit_interview_page',
        ];
        Activity::create($activity);

        return redirect()->route('interview.index', ['url' => $candidate_url]);
    }


    public function publicCandidate(string $candidate_id)
    {
        $candidate = Candidate::where([
            'share_link' => $candidate_id,
        ])
            ->first();
        if (empty($candidate)) {
            return redirect()->route('welcome');
        }
        if(!$candidate->share_allow){
            $questions = [];
            $answers = [];
            $count = 0;
            $user = User::find($candidate->user_id);
            $email = $user->email;
            return view('interview.public-candidate', compact("questions", "answers", 'candidate', "count", 'email'));
        }
        //fetch the answers for the candidate
        $answers = Answer::where([
            'candidate_id' => $candidate->id,
        ])->orderby('question_id', 'asc')
            ->get();
        if (count($answers) == 0) {
            return redirect()->route('welcome');
        }
        //fetch questions
        $questions = Questions::where([
            'job_id' => $candidate->job_id,
        ])->orderby('question_no', 'asc')
            ->get();
        if (count($questions) == 0) {
            return redirect()->route('welcome');
        }
        //check if the count of questions and answers is equal
        $count = count($questions);
        // return response()->json($question);
        return view('interview.public-candidate', compact("questions", "answers", 'candidate', "count"));
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

    public function privacy()
    {
        return view("privacy");
    }

}
