<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use App\VerifyUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Mail\VerifyRegister;
use Mail;

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

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'about' => 'required|string',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with([
              'msg' => $validator->errors()->first(),
              'header' => 'Oops! Something went wrong!',
              'status' => 'error'
            ]);
        }

        $createUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'about' => $request->about,
            'slug' => str_slug($request->name),
            'password' => Hash::make($request->password),
            'verify_token' => str_random(60)
        ]);

        if($createUser) {
            $sendMail = Mail::to($createUser->email)->send(new VerifyRegister($createUser));
            return redirect()->back()->with([
              'msg' => 'You have successfully registered. An email is sent to you for verification',
              'header' => 'Operation Success!',
              'status' => 'success'
            ]);
        }else{
            return redirect()->back()->with([
              'msg' => 'Registration Failed! Error code 500',
              'header' => 'Oops! Something went wrong!',
              'status' => 'error'
            ]);
        }
    }

    public function verify($token)
    {
        if (!$token){
            return redirect('login')->with([
              'msg' => 'Invalid Token!',
              'header' => 'Oops! Something went wrong!',
              'status' => 'error'
            ]);
        }

        $user = User::where('verify_token',$token)->first();

        if (!$user){
            return redirect('login')->with([
              'msg' => 'Invalid Token!',
              'header' => 'Oops! Something went wrong!',
              'status' => 'error'
            ]);
        }

        $user->verified = 1;

        if ($user->save()) {
            return redirect('login')->with([
              'msg' => 'Congratulations you can use this account now! Welcome to PHPBali!',
              'header' => 'Operation Success!',
              'status' => 'success'
            ]);
        }
    }
}
