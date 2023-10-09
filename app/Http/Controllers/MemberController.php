<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Job;
use App\Models\Company;
use App\Models\InvitedUsers;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
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
        $candidates = Candidate::join('companies', 'candidates.company_id', 'companies.id')
            ->join('jobs', 'candidates.job_id', 'jobs.id')
            ->where('candidates.user_id', '=', $user->id)
            ->where('candidates.status', '!=', 'init')
            ->select('candidates.*', 'jobs.title as job_title', 'companies.name as company_name')
            ->get();
        $jobs = Job::where('jobs.user_id', $user->id)
            ->orderBy('title', 'desc')
            ->get();
        $companies = Company::where(['owner' => $user->id])->orderBy('name', 'asc')->get();
        $owners = InvitedUsers::join('users', 'invited_users.inviter', '=', 'users.email')
            ->where(['invited_users.inviter' => $user->email])
            ->where('invited_users.user_id', '!=', 0)
            ->select("users.name as name", "invited_users.*")
            ->get();
        $name = $user->name;
        return view('member.index', compact('candidates', 'companies', 'owners', 'jobs', 'name'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $name = $request->input('name');
        $company = $request->input('company');
        $owner = $request->input('owner');
        $status = $request->input('status');
        $job = $request->input('job');
        $rate = $request->input('rate');

        $candidates = Candidate::join('companies', 'candidates.company_id', '=', 'companies.id')
            ->join('users', 'candidates.user_id', '=', 'users.id')
            ->join('jobs', 'candidates.job_id', '=', 'jobs.id')
            ->where('candidates.user_id', $user->id)
            ->where('candidates.status', '!=', 'init')
            ->when($name, function ($query) use ($name) {
                return $query->where('candidates.name', 'LIKE', '%' . $name . '%');
            })
            ->when($company, function ($query) use ($company) {
                return $query->where('companies.name', 'LIKE', '%' . $company . '%');
            })
            ->when($owner, function ($query) use ($owner) {
                return $query->where('users.name', 'LIKE', '%' . $owner . '%');
            })
            ->when($status, function ($query) use ($status) {
                return $query->where('candidates.status', $status);
            })
            ->when($job, function ($query) use ($job) {
                return $query->where('jobs.title', 'LIKE', '%' . $job . '%');
            })
            ->when($rate, function ($query) use ($rate) {
                return $query->where('candidates.review', $rate);
            })
            ->orderBy('candidates.created_at', 'desc')
            ->select('candidates.*', 'companies.name as company_name', 'jobs.title as job_title', 'users.name as user_name', 'users.email as email')
            ->get();

        return response()->json($candidates);
    }
    
    public function reject(Request $request, int $candidate_id)
    {
        $user = Auth::user();
        $candidate = Candidate::find($candidate_id);
        if(empty($user) || empty($candidate)){
            return response('', 400);
        }
        $candidate['status'] = "rejected";
        $reason = $request['reason'];
        $candidate->save();
        $activity = [
            'candidate_id' => $candidate->id,
            'content' => '候補者が'.$user->name.'によって拒否されました',
            'type' => 'reject',
            'name' => $user->name,
        ];
        Activity::create($activity);
        return response(['status' => 'success']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
}
