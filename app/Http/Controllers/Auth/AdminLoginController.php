<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use Session;

class AdminLoginController extends Controller
{
	public function __construct()
    {
        $this->middleware('guest:admin')->except('adminLogout');
    }

    protected function respondFailedLogin($email_count)
    {
        $message = "";
        if ($email_count  == 0) {
          $message = "Your email is invalid! Please enter a valid email";
        } else {
          $message = "Your password does not match our credentials!";
        }

        return redirect()->back()->with([
            'msg' => $message,
            'header' => 'Oops! Something went wrong!',
            'status' => 'error'
        ]);
    }

    public function showLoginForm()
    {
    	return view('auth.admin.login');
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
    	];

    	if (Auth::guard('admin')->attempt($fields, $request->remember)) {
    		return redirect()->intended(route('admin.home'));
    	}else{
            $email_count = Admin::where('email', $request->email)->count();
            return $this->respondFailedLogin($email_count);
        }
    }

    public function adminLogout()
    {
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
            Session::flush();
        }
        return redirect()->to(route('index'));
    }
}
