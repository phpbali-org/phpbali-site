<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Admin;
use Hash;
use Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backendViews.admin.home');
    }

    public function show() {
        $adminmeta = Auth::guard('admin')->user();

        return view('backendViews.admin.profile')->with('adminmeta', $adminmeta);
    }

    public function edit() {
        $adminmeta = Auth::guard('admin')->user();

        return view('backendViews.admin.edit')->with('adminmeta', $adminmeta);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,'.Auth::guard('admin')->user()->id,
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()) {
            return redirect()->back()->with('Error', $validator->errors()->first());
        }

        $update = Auth::guard('admin')->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        if($update){
            return redirect()->route('admin.home')->with('Success', 'Profil Berhasil di Update');
        }
    }
}
