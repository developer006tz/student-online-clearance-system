<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if($data['role']!='student'){
            return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        }else{

            return Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);

        }
        
    }

    private function generatePassword(){
        $password = rand(1, 99999) . substr(str_shuffle('@Bc)DeFg#km+p*l%z$k=yxt+Uv'), 0, 3);
        return $password;
    }

    private function generateUsername($email){
        $parts = substr(explode("@", $email)[0],0,4);
        $username = $parts . rand(1,9999);
        return $username;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $password = $this->generatePassword();
        $username = $this->generateUsername($data['email']);
        if ($data['role'] != 'student') {
             $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'username' => $username,
                'password' => Hash::make($data['password']),
            ]);
        }else{
             $user =  User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'username' => $username,
                'password' => Hash::make($password),
            ]);
        }

        $role = $data['role'];

        if ($role == 'student') {
            $role = 'Student';
            $user->assignRole(Role::findByName('student'));
        } elseif ($role == 'hall-wadern') {
            $role = 'hall-wadern';
            $user->assignRole(Role::findByName('hall-wadern'));
        } elseif($role=='librarian-udsm'){
            $role = 'librarian-udsm';
            $user->assignRole(Role::findByName('librarian-udsm'));
        }elseif($role=='librarian-cse'){
            $role = 'librarian-cse';
            $user->assignRole(Role::findByName('librarian-cse'));
        }elseif($role=='coordinator'){
            $role = 'coordinator';
            $user->assignRole(Role::findByName('coordinator'));
        }elseif($role=='principal'){
            $role = 'principal';
            $user->assignRole(Role::findByName('principal'));
        }elseif($role=='smart-card'){
            $role = 'smart-card';
            $user->assignRole(Role::findByName('smart-card'));
        }else{
            $role = 'user';
            $user->assignRole(Role::findByName('user'));
        }

        $sms = "You are registered as $role in UDSM Online Student Clearance System (UOSCS). Your username is $username and password is $password. Thanks for using UOSCS.";
        try {
            sendEmail($user->email, $user->name, 'NEW REGISTRATION', $sms);

        } catch (\Throwable $th) {
            $th->getMessage();
        }

        return $user;

    }
}
