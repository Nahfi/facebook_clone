<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::log;

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
    protected function validator( $data)
    {
        return $data->validate([




            "fname"=>"required",
            "lname"=>"required",
            "email"=>"required|email|unique:users,email",
            "password"=>"required|min:3|max:8|confirmed",
            "sex"=>"required",
            "date"=>"required|numeric",
            "month"=>"required|numeric ",
            "year"=>"required | numeric"
        

        ]);
    }

    public function showRegistrationForm()
    {
        return view('welcome');
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create($data)
    {



        $date=strtotime($data->get("year")."-".$data->get("month")."-".$data->get("month"));
        $x=date('Y-m-d',$date);
       
       


      $user=  User::create([
            'fname' => $data->fname,
            'lname' => $data->lname,
            'email' => $data->email,
           
            
            'password' => Hash::make($data->password),
            'sex' => $data->get("sex")=="male"? 1:0,
            'birthday'=>$x
        ]);
       Auth::loginUsingId($user->id);
        return $user;
    }
}
