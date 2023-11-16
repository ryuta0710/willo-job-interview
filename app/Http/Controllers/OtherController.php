<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Field;
use App\Models\Candidate;
use App\Models\Questions;
use App\Models\Answer;
use App\Models\Company;
use App\Models\User;

class OtherController extends Controller
{

    public function getJobList(Request $request)
    {
        $jobs = Job::join('companies', 'jobs.company_id', '=', 'companies.id')
            ->leftjoin('fields', 'jobs.field_id', '=', 'fields.id')
            ->where([
                'status' => 'live',
            ])
            ->orderby('updated_at', 'desc')
            ->select('jobs.*', 'companies.email as email', 'fields.name as field')
            ->take(20)
            ->get();

        $ex_fields = Field::query()->orderby('name', 'asc')->get()->toArray();

        $fields = array_slice($ex_fields, 0, 6);
        $ex_fields = array_slice($ex_fields, 6, count($ex_fields) - 1);

        return view('jobList', compact('fields', 'ex_fields', 'jobs'));
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
        $jobs = Job::join('companies', 'jobs.company_id', '=', 'companies.id')
            ->leftjoin('fields', 'jobs.field_id', '=', 'fields.id')
            ->where([
                'status' => 'live',
            ])
            ->when($field_id, function ($query) use ($field_id) {
                return $query->where('field_id', $field_id);
            })
            ->where('description', 'LIKE', '%' . $search_key . '%')
            ->whereBetween('salary', [$salary_min, $salary_max])
            ->orderby('updated_at', 'desc')
            ->select('jobs.*', 'companies.email as email', 'fields.name as field')
            ->skip($offset)
            ->take(20)
            ->get();

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
            ->leftJoin('fields', 'companies.field', '=', 'fields.id')
            ->select('jobs.*', 'fields.name as field', 'companies.email as email', 'companies.website as website', 'companies.name as company_name')
            ->first();
        if (empty($job)) {
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
        if ($job->status == "closed") {
            return redirect()->route('interview.interview_closed');
        }
        if ($job->limit_date) {
            $limit_date = date("Y/m/d", strtotime($job->limit_date));
            $now = date('Y/m/d');
            if ($now > $limit_date) {
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
        if (!$candidate->share_allow) {
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

    public function openai(Request $request)
    {
        $apikey =  config('app.OPENAI_API_KEY');
        $url = "https://api.openai.com/v1/chat/completions";

        // リクエストヘッダー
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . $apikey
        );

        $prompt = $request["prompt"];

        // リクエストボディ
        $data = array(
            'model' => 'gpt-4',
            'messages' => [
                ["role" => "system", "content" => "日本語で返信する。
これからは面接官だと思い、ユーザーに質問をしなければなりません。
日本語で質問をする面接官になりましょう。
絶対に答えないでください。 
最も重要なのは、質問だけをすることです。
＃制約は次のとおりです。
・まず職業説明についての最初の質問をしてください。
・その後、ユーザーは答えます。
・ユーザーから回答を受けた後、別の質問をもう一度お試しください。
・20個の質問をしたら終了します。
・質問だけを提示してください
・インタビューが完了したら完了したと答えてください。"],
                ['role' => 'user', 'content' => $prompt],
            ],
            'max_tokens' => 500,
        );

        // cURLを使用してAPIにリクエストを送信
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);

        // 結果をデコード
        $result = json_decode($response, true);
        // $result_message = $result["choices"][0]["message"]["content"];

        // 結果を出力
        return response()->json([
            'status' => 'success',
            'result' => $result,
        ]);
    }
}
