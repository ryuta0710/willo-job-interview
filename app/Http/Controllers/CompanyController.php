<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyCreate;
use Illuminate\HTTP\Response;
use App\Models\Company;
use App\Models\Field;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Intervention\Image\Facades\Image;
use Symfony\Component\VarDumper\Caster\RedisCaster;

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
        $list = Company::where("owner", $user->id)->get();

        return view('company.index', compact("list"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('company.create');
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

        if (!empty($request['address']) && !is_null($request['address'])) {
            $data['address'] = $request['address'];
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

        Company::create($data);


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

            if (!empty($request['address']) && !is_null($request['address'])) {
                $data['address'] = $request['address'];
            }else{
                $data['address'] = '';
            }
            if (!empty($request['website']) && !is_null($request['website'])) {
                $data['website'] = $request['website'];
            }else{
                $data['website'] = '';
            }
            if (!empty($request['header_color']) && !is_null($request['header_color'])) {
                $data['header_color'] = $request['header_color'];
            }else{
                $data['header_color'] = '';
            }
            if (!empty($request['button_color']) && !is_null($request['button_color'])) {
                $data['button_color'] = $request['button_color'];
            }else{
                $data['button_color'] = '';
            }
            if (!empty($request['field']) && !is_null($request['field'])) {
                $data['field'] = $request['field'];
            }else{
                $data['field'] = '';
            }
            $default = $request->has('default') ? true : false;
            if ($default) {
                Company::where("owner", $user->id)->update([
                    'default' => '',
                ]);
                $data['default'] = 'true';
            }

            $data->save();

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
}
