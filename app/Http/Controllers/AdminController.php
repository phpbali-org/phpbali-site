<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Admin;
use Hash;

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

    public function show($id) {
        $admins = new Admin;

        $adminmeta = $admins::where('id', $id)->first();

        return view('backendViews.admin.profile')->with('adminmeta', $adminmeta);
    }

    public function edit($id) {
        $admins = new Admin;

        $adminmeta = $admins::where('id', $id)->first();

        return view('backendViews.admin.edit')->with('adminmeta', $adminmeta);
    }

    public function update(Request $request, $id) {
        $admins = new Admin;

        $request->validate([
            'name',
            'email' => 'email',
            'password'
        ]);

        $oldAdminMeta = $admins::where('id', $id)->first();

        $newAdminMeta = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        $oldAdminMeta->update($newAdminMeta);

        return redirect()->route('admin.home')->with('success', 'Profil Berhasil di Update');
    }
}
