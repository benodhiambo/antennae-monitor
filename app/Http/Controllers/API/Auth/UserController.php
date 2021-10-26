<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\User;
use App\Contractor;
use App\Code;
use AfricasTalking\SDK\AfricasTalking;
use App\Role;

class UserController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [id] contractor_id
     * @param  [id] team_id
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required|unique:users',
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = Hash::make($input['phone']);
        $user = User::create($input);
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */

    public function sendMessage($phone, $message)
    {
        $username = config('services.africaIsTalking.username');
        $apiKey =config('services.africaIsTalking.secret');
        $AT = new AfricasTalking($username, $apiKey);

        // Get one of the services
        $sms = $AT->sms();

        // Use the service
        $result = $sms->send([
            'to' => $phone,
            'message' => $message
        ]);

        return $result;
    }

    public function login(Request $request)
    {
        //validate input
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = request(['email', 'password']);

        //check if user exists
        $email =$request->get('email');
        if (!Auth::attempt($credentials))
        {

            Log::info('User failed to login  :'.$email,[ 'result' => 'failure']);
            return response()->json(['status' => 'failure', 'data' => ['message' => 'Wrong email or password']], 401);

        }
        //if user exists and the password matches the email, send an authentication code via text
       // dd(request()->headers);
        $user = $request->user();
        $phone = $user->phone;

        $code = rand(100000, 900000);
        $message = "<#> Your authentication code is  " . $code . "  L3Lp8YFxrFq";

        //send message
        $result = $this->sendMessage($phone, $message);

        //save the code in the db
        if ($result['status'] == "success") {
            $user_id = $user->id;
            if (Code::where('user_id', '=', $user_id)->delete()) {
                Code::create(['user_id' => $user_id, 'code' => $code]);
            } else {
                Code::create(['user_id' => $user_id, 'code' => $code]);

            }
            return response()->json(['status' => $result['status'], 'data' => $user], 200);
        }

    }

    public function generateToken($id, Request $request)
    {
        $user = User::with('role')->where('id', '=', $id)->first();


        $code = Code::where('user_id', '=', $id)->first();
        if ($request->get('code') == $code->code) {

            $tokenResult = $user->createToken('Personal Access Token');

            //delete authentication code after successful login
            Code::find($code->id)->delete();
            Log::info('Login successful',['type' =>'access','result' => 'success']);
            return response()->json([
                'status' => 'success',
                'access_token' => $tokenResult->accessToken,
                'role' => $user->role->role_name,
                'type' => 'Bearer'
            ], 200);
        } else {
            return response()->json(['status' => 'failure', 'data' => ['message' => 'wrong code']], 400);
        }
    }

    public function updatePassword(Request $request)
    {
        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($request->get('password'));
        $user->password_change_at = true;
        if ($user->save()) {
            return response()->json(['status' => 'success', 'data' => $user], 200);
        } else {
            return response()->json(['status' => 'failure', 'data' => ['message' => 'password update failed']], 404);
        }

    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
    }

    /**
     * forgot password
     * @params - phone
     */
    public function forgotPassword(Request $request)
    {

        //validate input
        $request->validate([
            'phone' => 'required',
        ]);
        $phone = $request->get('phone');
        $generatedCode = rand(200000, 999999);
        $message = "Your new password is  " . $generatedCode;
        $user = User::where('phone', $phone)->first();
        //dd($user);

        if ($user) {
            $user->password = Hash::make($generatedCode);
            $user->password_change_at = false;
            $user->save();

            $result = $this->sendMessage($phone, $message);
            return response()->json(['status' => $result['status'], 'data' => 'Password sent'], 200);

        } else {
            return response()->json(['status' => 'Failure', 'data' => ['message'=> 'Phone number does not exist']], 404);
        }

    }

}
