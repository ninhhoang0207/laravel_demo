<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Jobs\SendEmail;
use DB, Redirect, Session;

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
    protected $redirectTo = '/login';

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
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',
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
        $role_member;

        if (isset($data['role'])) {
            $role_member = $data['role'];
        } else {
            $role_member = DB::table('roles')->where('slug', 'member')->first();
            if (count($role_member) > 0) 
                $role_member = $role_member->id;
            else {
                Session::flash('error', trans('role_not_found'));

                return Redirect::back()->withInput();
            }
        }

        $user = User::create([
            'name'      =>  $data['name'],
            'email'     =>  $data['email'],
            'password'  =>  bcrypt($data['password']),
            'is_active' =>  0,
            'role'      =>  $role_member,
            'address'   =>  $data['address'],
            'phone'     =>  $data['phone'],
            'active_code'=>  str_random(64),
            'birthday'  =>  $this->formatDate($data['birthday'])
        ]);

        return $user;
    }

    protected function sendActivationEmail($user) {
        dispatch(new SendEmail($user));
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $this->sendActivationEmail($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}
