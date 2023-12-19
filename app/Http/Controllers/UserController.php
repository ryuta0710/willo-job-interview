<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Models\InvitedUsers;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $invited_users = InvitedUsers::where('inviter', $user->email)->get();
        $display_users = [];

        foreach ($invited_users as $invited_user) {
            if ($invited_user->user_id) {
                $user_data = User::find($invited_user->user_id);


                if (!empty($user_data)) {
                    $invited_user->name = $user_data->name;
                    $invited_user->phone = $user_data->phone ?? '—';
                } else {
                    $invited_user->name = '—';
                    $invited_user->phone = '—';
                }

                $display_users[] = $invited_user;
            } else {
                $invited_user->name = '—';
                $invited_user->phone = '—';
                if ($invited_user->status == "joined") {
                    $invited_user->status = "参加しました";
                } else {
                    $invited_user->status = "招待しました";
                }
                $display_users[] = $invited_user;
            }
            if ($invited_user->role == "admin") {
                $invited_user->role = "管理者";
            } else {
                $invited_user->role = "一般ユーザー";
            }
            if ($invited_user->status == "joined") {
                $invited_user->status = "参加しました";
            } else {
                $invited_user->status = "招待しました";
            }
        }

        return view('user.index', compact("user", 'display_users'));
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
        $user = Auth::user();

        if (!empty($user)) {
            redirect("home");
        }

        $email = $request['email'];
        $role = $request['role'];

        $request->validate([
            'email' => 'required',
            'role' => 'required',
        ]);
        $exist = InvitedUsers::where([
            'email' => $email,
            'inviter' => $user->email,
        ])->first();
        // return response()->json(empty($exist));
        //check if the invite user is registred in invited_users table
        if (!empty($exist)) {
            return response()->json([
                'status' => 'failed',
                'message' => 'すでに招待されているユーザーです。',
            ], Response::HTTP_BAD_REQUEST);
        }

        $data = [
            'email' => $email,
            'inviter' => $user->email,
            'role' => $role,
            'user_id' => 0
        ];
        //check if the email is regigtred in the user table
        $temp = User::where([
            'email' => $email,
        ])->first();

        if (!empty($temp)) {
            $data['user_id'] = $temp->id;
            $data['status'] = 'joined';
        }else {
            $data['status'] = 'invited';
        }

        $save_data = InvitedUsers::create($data);

        if (!empty($temp)) {
            $save_data['phone'] = $temp->phone;
            $save_data['name'] = $temp->name;
            $save_data['status'] = '参加しました';
        }else{
            $save_data['status'] = '招待しました';
        }
        if(!$save_data['phone']) {
            $save_data['phone'] =  '—';
        }
        if(!$save_data['name']) {
            $save_data['name'] =  '—';
        }

        return response()->json([
            'status' => 'success',
            'data' => $save_data,
        ], Response::HTTP_OK);
    }
    /**
     * Store a newly invited user in storage.
     */
    public function store_invite_user(Request $request)
    {

        // $user = Auth::user();
        // if ($user) {
        //     $invite_email = $request->email;
        //     $role = $request->role;
        //     $invite_user  = User::where("email", $invite_email)->first();
        //     if ($invite_user == null) {
        //         $data = [
        //             "email" => "invite_email",
        //             "inviter" => $user->email,
        //             "role" => $role,
        //         ];
        //         InvitedUsers::create($data);
        //     }


        //     return response()->json([
        //         'status' => 'success',
        //     ], Response::HTTP_OK);
        // }
        // redirect("home");
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
        $role = $request['role'];
        $user = InvitedUsers::find($id);

        if(!empty($user)){
            if($role == "admin"){
                $user['role'] = 'admin';
            }else {
                $user['role'] = 'standard';
            }
            $user->save();
            return response()->json($user);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = InvitedUsers::find($id);
        $email = Auth::user()->email;
        if (empty($email))
            redirect("home");
        if (!empty($user)) {
            $user->delete();
            return response()->json([
                'status' => 'success',

            ], Response::HTTP_OK);
        }

        return response()->json([
            'status' => 'failed',
            'message' => '削除操作が失敗しました。',
        ], Response::HTTP_BAD_REQUEST);
    }
}
