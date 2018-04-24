<?php

namespace App\Http\Controllers\Auth;

use App\address;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

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
  'User_Name' => 'required|regex:/^([a-zA-Zก-ูเ-๋])/|min:5|max:255',
  'email' => 'required|string|email|max:255|unique:users,email',
  'password' => 'required|string|min:6|confirmed',
  'User_Address' => 'required|string',
  'User_Tel'=>'required|numeric|digits:10',
  'tumbon'  => 'required|regex:/^([ก-ูเ-๋])/',
  'aumpor'  => 'required|regex:/^([ก-ูเ-๋])/',
  'province' => 'required|regex:/^([ก-ูเ-๋])/',
  'zipcode' => 'required|numeric|digits:5',
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

        return User::create([
                'User_Name' =>  $data['User_Name'],
                'email' => $data['email'],
                'address_id' => 0,
                'remember_token' => $data['_token'],
                'password' =>  bcrypt($data['password']),
        ]);



    }
}
