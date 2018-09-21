<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function respondFailedLogin($user, $verified_status)
    {
        $message = "";
        if (!isset($user)) {
            $message = "Your email is invalid! Please enter a valid email";
        } else {
            if($verified_status == 0) {
                $message = "Sorry, your account is not verified. Please verify your account first";
            } else {
                $message = "Your password does not match our credentials!";
            }
        }

        return redirect()->back()->with([
          'msg' => $message,
          'header' => 'Oops! Something went wrong!',
          'status' => 'error'
        ]);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with([
              'msg' => $validator->errors()->first(),
              'header' => 'Oops! Something went wrong!',
              'status' => 'error'
            ]);
        }

        $fields = [
            'email' => $request->email,
            'password' => $request->password,
            'verified' => 1,
        ];

        if(Auth::attempt($fields, $request->remember)){
            return redirect()->intended(route('index'));
        }else{
            $user = User::where('email', $request->email)->first();

            if(isset($user)){
                return $this->respondFailedLogin($user, $user->verified);
            }else{
                return $this->respondFailedLogin($user, 0);
            }
        }
    }

    public function logout()
    {
      if(Auth::guard('web')->check()){
        Auth::guard('web')->logout();
        Session::flush();
      }
      return redirect()->to(route('index'));
    }
}
