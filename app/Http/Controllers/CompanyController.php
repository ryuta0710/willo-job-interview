<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyCreate;
use Illuminate\Http\Response;
use App\Models\Company;
use App\Models\Field;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Carbon;
use App\Models\Candidate;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Collection;

class CompanyController extends Controller
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
        $user = Auth::user();
        $list = Company::where("owner", $user->id)->withCount("candidates")->get()->sortBy("id")->sortByDesc("default");

        return view('company.index', compact("list"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $fields = Field::query()->orderby('name', 'asc')->get();
        return view('company.create', compact('fields'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyCreate $request)
    {
        $user = Auth::user();
        $data = [
            'name' => $request['name'],
        ];

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $fileName = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(120, 120, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->stream(); // <-- Key point

            $image->move(public_path('/assets/upload/company_logos/'), $fileName);
            $data['logo'] = $fileName;
        }

        if (!empty($request['email']) && !is_null($request['email'])) {
            $data['email'] = $request['email'];
        }
        if (!empty($request['website']) && !is_null($request['website'])) {
            $data['website'] = $request['website'];
        }
        if (!empty($request['header_color']) && !is_null($request['header_color'])) {
            $data['header_color'] = $request['header_color'];
        }
        if (!empty($request['button_color']) && !is_null($request['button_color'])) {
            $data['button_color'] = $request['button_color'];
        }
        if (!empty($request['field']) && !is_null($request['field'])) {
            $data['field'] = $request['field'];
        }
        $default = $request->has('default') ? true : false;
        if ($default) {
            Company::where("owner", $user->id)->update([
                'default' => '',
            ]);
            $data['default'] = 'true';
        }

        $user_id = Auth::user()->id;
        $data['owner'] = $user_id;
        $company = Company::create($data);
        $user = User::find($user_id);
        $user['main_company_id'] = $company->id;
        $user->save();


        return redirect()->route('company.index');
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

        $user_id = Auth::user()->id;

        $company = Company::find($id);

        if (!empty($company)) {
            $fields = Field::orderBy('name', 'asc')->get();
            return view("company.update", compact('company', 'fields'));
        }
        return view("company.index");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyCreate $request, string $id)
    {

        $data = Company::find($id);

        if (!empty($data)) {
            $user = Auth::user();
            $data['name'] = $request['name'];

            if ($request->hasFile('logo')) {

                $image = $request->file('logo');
                $fileName = time() . '.' . $image->getClientOriginalExtension();

                $img = Image::make($image->getRealPath());
                $img->resize(120, 120, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $img->stream(); // <-- Key point

                $image->move(public_path('/assets/upload/company_logos/'), $fileName);
                $data['logo'] = $fileName;
            }

            if (!empty($request['email']) && !is_null($request['email'])) {
                $data['email'] = $request['email'];
            } else {
                $data['email'] = '';
            }
            if (!empty($request['website']) && !is_null($request['website'])) {
                $data['website'] = $request['website'];
            } else {
                $data['website'] = '';
            }
            if (!empty($request['header_color']) && !is_null($request['header_color'])) {
                $data['header_color'] = $request['header_color'];
            } else {
                $data['header_color'] = '';
            }
            if (!empty($request['button_color']) && !is_null($request['button_color'])) {
                $data['button_color'] = $request['button_color'];
            } else {
                $data['button_color'] = '';
            }
            if (!empty($request['field']) && !is_null($request['field'])) {
                $data['field'] = $request['field'];
            }
            $default = $request->has('default') ? true : false;
            if ($default) {
                Company::where("owner", $user->id)->update([
                    'default' => '',
                ]);
                $data['default'] = 'true';
            }

            $data->save();
            $user = User::find($user->id);
            $user['main_company_id'] = $data->id;
            $user->save();

            return redirect()->route('company.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user_id = Auth::user()->id;

        $company = Company::find($id);

        if (!empty($company)) {
            if ($user_id == $company->owner) {
                if ($company->default != 'true') {
                    $company->delete();
                    return response()->json([
                        'status' => 'success',
                        'message' => '既定設定された会社なので削除できません。'
                    ], Response::HTTP_OK);
                }
            }
        }
        return response()->json([
            'status' => 'failed',
            'message' => '削除操作が失敗しました。',
            'data' => $company,
        ], Response::HTTP_BAD_REQUEST);
    }
    public function detail(string $id)
    {
        $company = Company::find($id);
        if (empty($company)) {
            return response()->json(['status' => 'failed', 'message' => 'The company doesn\'t exist']);
        }
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $user = Auth::user();

        $live_jobs_count = $company
            ->jobs()
            ->where(['status' => 'live', 'company_id' => $id])
            ->count();

        $candidates = Candidate::where('user_id', $user->id)
            ->where('company_id', $id)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->get();
        $responses = $candidates
            ->where('company_id', $id)
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

        $jobs = Job::where(['user_id' => $user->id, 'company_id' => $company->id])
            ->get();
        foreach($jobs as $job){
            $started = Candidate::where('job_id', $job->id)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
                ->count();
            $responsed = Candidate::where('job_id', $job->id)
            ->where('status', '!=', 'init')
                ->count();
            $job['started'] = $started;
            $job['responsed'] = $responsed;
        }

        return view('company.detail', compact('responses_count', 'all_count', 'live_jobs_count', 'candidates_data', 'response_data', 'company', 'jobs'));
    }

    public function fetch(string $id, string $period)
    {
        $company = Company::find($id);
        if (empty($company)) {
            return response()->json(['status' => 'failed', 'message' => 'The company doesn\'t exist']);
        }

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

        if ($period == "curMonth" || $period == "pastMonth") {
            $candidates = Candidate::where('user_id', $user->id)
                ->where('company_id', $id)
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)->get();

            $responses = $candidates
                ->where('status', '!=', 'init');
        } else if ($period == 'today') {
            $today = Carbon::now()->format('Y-m-d');
            $str_yes = Carbon::now()->subDay()->format('m-d');
            $candidates = Candidate::where('user_id', $user->id)
                ->where('company_id', $id)
                ->whereDate('created_at', $today)->get();

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
        } else if ($period == 'yesterday') {
            $yesterday = Carbon::now()->subDay()->format('Y-m-d');
            $str_yes = Carbon::now()->subDay()->format('m-d');
            $candidates = Candidate::where('user_id', $user->id)
                ->where('company_id', $id)
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
        } else if ($period == '7days') {
            $startDate = Carbon::now()->subDays(7)->startOfDay();
            $currentDate = Carbon::now()->endOfDay();
            $yesterday = Carbon::now()->subDay()->format('Y-m-d');
            $candidates = Candidate::where('user_id', $user->id)
                ->where('company_id', $id)
                ->whereBetween('created_at', [$startDate, $currentDate])
                ->get();

            $responses = $candidates
                ->where('status', '!=', 'init');
        } else if ($period == '30days') {
            $startDate = Carbon::now()->subDays(30)->startOfDay();
            $currentDate = Carbon::now()->endOfDay();
            $yesterday = Carbon::now()->subDay()->format('Y-m-d');
            $candidates = Candidate::where('user_id', $user->id)
                ->where('company_id', $id)
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
        ], Response::HTTP_OK);
    }
}
