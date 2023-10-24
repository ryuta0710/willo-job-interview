<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\HTTP\Response;
use App\Models\Company;
use App\Models\User;
use App\Models\InvitedUsers;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $org = Company::where("id", $user->main_company_id)
        ->get()->first();
        if(!$org){
            return response('Bad Request', 400);
            $org = "";
        }
        $inviter_count = InvitedUsers::where("inviter", "=", $user->email)->count() + 1;

        return view('profile.index', compact("user", "org", "inviter_count"));
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
    public function update(Request $request)
    {
        if ($request->has(['org_name', 'phone'])) {
            $user = Auth::user();
            $newPhone = $request['phone'];
            $newName = $request['org_name'];
    
            $profile = User::where('id', $user->id)->first();
            $profile->phone = $newPhone;
            $profile->save();
            $main_company_id = $profile->main_company_id;
            $org = Company::where('id', $main_company_id)->first();
            $org->name = $newName;
            $org->save();
            return response()->json([
                'status' => "ok",
            ], Response::HTTP_OK);
        } else {
            return response('Bad Request', 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
