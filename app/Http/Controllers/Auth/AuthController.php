<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


use Illuminate\Http\Request;
// use App\Http\Requests\LoginRequest;
// use App\Http\Requests\Auth\RegisterRequest;

class AuthController extends Controller
{
    // protected $redirectTo = '/error';
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function postLogin(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);

        // prevent login 
        if ($validator->fails()) {
            // get the error messages from the validator
            return view('api.error')->withErrors($validator);
        }

        // if validation passes this code will execute
        if (Auth::attempt($request->all())) {
            $user = Auth::user();
            echo '<pre>' . print_r($user, 1) . '</pre>';
            // return view('api.success')->with('message', $user);
        }

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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
