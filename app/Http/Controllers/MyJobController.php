<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


use Illuminate\Http\Request;

class MyJobController extends Controller
{
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
        return view('myjob.edit');
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
        return view('myjob.create_questions', compact('myjob'));
    }
}
