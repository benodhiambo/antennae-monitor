<?php

namespace App\Http\Controllers\Auth;

use App\Contractor;
use App\Http\Controllers\Controller;
use App\PasswordHistory;
use App\User;
use App\Role;
use App\Team;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use AfricasTalking\SDK\AfricasTalking;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function showUserlist()
    {
        $users = User::all();
        $roles = Role::all();
        return view('auth.userlist' ,compact('users', 'roles'));
    }

    public function showAddUserForm()
    {
        $roles= Role::all();
        $cons = Contractor::all();
        $teams= Team::all();
        return view('auth.register_user',compact('cons','roles','teams'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'unique:users'],
            'role_id' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
      $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'role_id' => $data['role_id'],
            'contractor_id' => array_key_exists('contractor_id', $data) ? $data['contractor_id'] : Null,
            'team_id' => array_key_exists('team_id', $data) ? $data['team_id'] : Null,
            'password' => Hash::make($data['password']),
        ]);
      if ($user){
          //inform user of their registration and send them a one time password
          $message = "Hello ".$data['name'].", you have been registered on Antenna-Monitor. Your password is  ". $data['password'];
          $this->sendMessage($data['phone'],$message);

          //save user's password
          $password_history = PasswordHistory::create(
          [
              'user_id' =>$user->id,
              'password' => Hash::make($data['password'])

          ]);
          Log::info('New User Created:' .$data['email'] .'with role :' .$data['role_id'],['type' =>'create','result' => 'success']);
      }

      return  $user;
    }


}
