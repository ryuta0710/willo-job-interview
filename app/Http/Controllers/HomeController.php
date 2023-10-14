<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Candidate;
use App\Models\InvitedUsers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Http\Response;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $user = Auth::user();
        $companies = User::find($user->id)
            ->companies()
            ->get();

        $first_interview = Candidate::where('user_id', $user->id)->first();
        $exist_first_interview = !empty($first_interview);
        $first_inviter = InvitedUsers::where('inviter', $user->email)->first();
        $exist_invited_user = !empty($first_inviter);

        $live_jobs_count = User::find($user->id)
            ->jobs()
            ->where(['status' => 'live'])
            ->count();

        $candidates = Candidate::where('user_id', $user->id)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->get();
        $responses = $candidates
            ->where('status', '!=', 'init');
        //group
        $candidates = $candidates->sortBy('created_at');
        $responses = $responses->sortBy('created_at');

        $candidatesByDate = $candidates->groupBy(function ($candidate) {
            return Carbon::parse($candidate['created_at'])->format('m-d');
        });
        $responsesByDate = $responses->groupBy(function ($candidate) {
            return Carbon::parse($candidate['created_at'])->format('m-d');
        });
        // $responsesByDate = $candidates->groupBy(function ($candidate) {
        //     return Carbon::parse($candidate['created_at'])->format('Y-m-d');
        // });
        $startDate = Carbon::now()->startOfMonth();
        $currentDate = Carbon::now();
        $candidates_data = [];
        $response_data = [];

        while ($startDate->lte($currentDate)) {
            $date = $startDate->format('m-d');
            $data1 = [
                'date' => $date,
            ];
            $data2 = [
                'date' => $date,
            ];
            if ($candidatesByDate[$date] ?? null) {
                $data1['count'] = count($candidatesByDate[$date]);
            } else {
                $data1['count'] = 0;
            }
            if ($responsesByDate[$date] ?? null) {
                $data2['count'] = count($responsesByDate[$date]);
            } else {
                $data2['count'] = 0;
            }
            $candidates_data[] = $data1;
            $response_data[] = $data2;
            $startDate->addDay();
        }
        $responses_count = count($responses);
        $all_count = count($candidates);


        return view('home', compact('responses_count', 'all_count', 'live_jobs_count', 'candidates_data', 'response_data', 'exist_first_interview', 'exist_invited_user'));
    }

    public function fetch(string $period)
    {
        $user = Auth::user();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        if ($period == "pastMonth") {
            $currentMonth = Carbon::now()->subMonth()->month;
            $currentYear = Carbon::now()->subMonth()->year;
        }
        $candidates = new Collection();
        $responses = new Collection();
        $startDate = Carbon::now()->startOfMonth();
        $currentDate = Carbon::now();
        if ($period == "pastMonth") {
            $startDate = Carbon::now()->subMonth()->startOfMonth();
            $currentDate = Carbon::now()->subMonth()->endOfMonth();
        }

        if($period == "curMonth" || $period == "pastMonth"){
            $candidates = Candidate::where('user_id', $user->id)
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)->get();
            
            $responses = $candidates
                ->where('status', '!=', 'init');
        }else if($period == 'today'){
            $today = Carbon::now()->format('Y-m-d');
            $str_today = Carbon::now()->format('m-d');
            $candidates = Candidate::where('user_id', $user->id)
                ->whereDate('created_at', $today)->get();
            
            $responses = $candidates
                ->where('status', '!=', 'init');
            return response()->json([
                'response_data' => [
                    [
                        'date' => $str_today,
                        'count' => count($responses),
                    ]
                ],
                'candidates_data' => [
                    [
                        'date' => $str_today,
                        'count' => count($candidates),
                    ]
                ],
                'responses_count' => count($responses),
                'all_count' => count($candidates),
                // 'responses' => $responses,
            ], Response::HTTP_OK);
            
        }else if($period == 'yesterday'){
            $yesterday = Carbon::now()->subDay()->format('Y-m-d');
            $str_yes = Carbon::now()->subDay()->format('m-d');
            $candidates = Candidate::where('user_id', $user->id)
                ->whereDate('created_at', $yesterday)->get();
            
            $responses = $candidates
                ->where('status', '!=', 'init');
            return response()->json([
                'response_data' => [
                    [
                        'date' => $str_yes,
                        'count' => count($responses),
                    ]
                ],
                'candidates_data' => [
                    [
                        'date' => $str_yes,
                        'count' => count($candidates),
                    ]
                ],
                'responses_count' => count($responses),
                'all_count' => count($candidates),
                // 'responses' => $responses,
            ], Response::HTTP_OK);
        }else if($period == '7days'){
            $startDate = Carbon::now()->subDays(7)->startOfDay();
            $currentDate = Carbon::now()->endOfDay();
            $yesterday = Carbon::now()->subDay()->format('Y-m-d');
            $candidates = Candidate::where('user_id', $user->id)
                ->whereBetween('created_at', [$startDate, $currentDate])
                ->get();
            
            $responses = $candidates
                ->where('status', '!=', 'init');
        }else if($period == '30days'){
            $startDate = Carbon::now()->subDays(30)->startOfDay();
            $currentDate = Carbon::now()->endOfDay();
            $yesterday = Carbon::now()->subDay()->format('Y-m-d');
            $candidates = Candidate::where('user_id', $user->id)
                ->whereBetween('created_at', [$startDate, $currentDate])
                ->get();
            
            $responses = $candidates
                ->where('status', '!=', 'init');
        }
        //group
        $candidates = $candidates->sortBy('created_at');
        $responses = $responses->sortBy('created_at');

        $candidatesByDate = $candidates->groupBy(function ($candidate) {
            return Carbon::parse($candidate['created_at'])->format('m-d');
        });
        $responsesByDate = $responses->groupBy(function ($candidate) {
            return Carbon::parse($candidate['created_at'])->format('m-d');
        });
        // $responsesByDate = $candidates->groupBy(function ($candidate) {
        //     return Carbon::parse($candidate['created_at'])->format('Y-m-d');
        // });
        $candidates_data = [];
        $response_data = [];

        while ($startDate->lte($currentDate)) {
            $date = $startDate->format('m-d');
            $data1 = [
                'date' => $date,
            ];
            $data2 = [
                'date' => $date,
            ];
            if ($candidatesByDate[$date] ?? null) {
                $data1['count'] = count($candidatesByDate[$date]);
            } else {
                $data1['count'] = 0;
            }
            if ($responsesByDate[$date] ?? null) {
                $data2['count'] = count($responsesByDate[$date]);
            } else {
                $data2['count'] = 0;
            }
            $candidates_data[] = $data1;
            $response_data[] = $data2;
            $startDate->addDay();
        }
        $responses_count = count($responses);
        $all_count = count($candidates);

        return response()->json([
            'response_data' => $response_data,
            'candidates_data' => $candidates_data,
            'responses_count' => $responses_count,
            'all_count' => $all_count,
            // 'responses' => $responses,
        ], Response::HTTP_OK);
    }
}
