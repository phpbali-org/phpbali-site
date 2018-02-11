<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class AdminLoginController extends Controller
{
	public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
    	return view('auth.admin.login');
    }

    public function login(Request $request)
    {
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:6'
    	]);

    	$fields = [
    		'email' => $request->email,
    		'password' => $request->password,
    	];

    	if (Auth::guard('admin')->attempt($fields, $request->remember)) {
    		return redirect()->intended(route('admin.home'));
    	}else{
             return redirect()->back()->with('Error', 'Password atau Email yang kamu masukkan salah! Silahkan di cek kembali');
        }

    	return redirect()->back()->withInput($request->only('email', 'remember'));
    }
}
