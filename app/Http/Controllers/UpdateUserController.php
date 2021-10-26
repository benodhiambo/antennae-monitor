<?php

namespace App\Http\Controllers;

use App\Contractor;
use App\Role;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UpdateUserController extends Controller
{
    protected $redirectTo = '/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function showMyProfile($user_id)
    {
        $myDetails = DB::table('users')->where('id', '=', $user_id)->get();
        return view('auth.my_profile', compact('myDetails'));
    }

    public function showUserProfile($user_id)
    {
        $roles= Role::all();
        $cons = Contractor::all();
        $teams= Team::all();
        $userDetails = DB::table('users')->where('id', '=', $user_id)->get();
        return view('auth.user_profile', compact('userDetails', 'cons','roles','teams'));
    }

    public function showChangePasswordPage()
    {
        return view('auth.change_password');
    }

    public function processPasswordChange($user_id, Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'password' => ['required', 'string', 'max:255']
            ]);
            $user = User::find($user_id);
            $user->password = Hash::make($request->password);
            $update = $user->save();
            
            if ($update)
            {
                Log::info(' User Password updated:' . $request->email, ['type' => 'update', 'result' => 'success']);
            }
            return back();
        }
    }

    public function updateUserDetails($id, Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required'],
            'role_id' => ['required'],
            'contractor' => ['required'],
            'team' => ['required'],
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->status = $request->status;
        $user->role_id = $request->role_id;
        $user->contractor_id = $request->contractor;
        $user->team_id = $request->team;

        if ($request->password === null) {
            $update = $user->save();
        } else {
            $user->password = Hash::make($request->password);
            $update = $user->save();
        }
        
        if ($update)
        {
            Log::info(' User Details updated:' . $request->email, ['type' => 'update', 'result' => 'success']);
        }
        return back();
    }
}
