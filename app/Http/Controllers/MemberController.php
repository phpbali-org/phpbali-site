<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use DB;

class MemberController extends Controller
{
    const VERIFIED = '1';

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = User::where('verified', '1')->paginate(15);
        return view('backendViews.admin.members.index')
        ->with('members', $members);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $generalOptions = array(
            '0' => 'No',
            '1' => 'Yes'
        );

        return view('backendViews.admin.members.add')
        ->with('general_options', $generalOptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('Error', 'Pastikan anda mengisi seluruh field yang diminta!');
        }

        $store = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_staff' => $request->is_staff,
            'verified' => self::VERIFIED
        ]);

        if ($store) {
            return redirect()->route('admin.members')->with('Success', 'Member berhasil dibuat!');
        } else {
            return redirect()->back()->with('Error', 'Telah terjadi kesalahan, silahkan hubungi administrator!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $generalOptions = array(
            '0' => 'No',
            '1' => 'Yes'
        );

        $member = User::where('id', $id)->first();

        return view('backendViews.admin.members.edit')
        ->with('member', $member)
        ->with('general_options', $generalOptions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('Error', 'Pastikan anda mengisi seluruh field yang diminta!');
        }

        $update = User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'is_staff' => $request->is_staff,
        ]);

        if ($update) {
            return redirect()->route('admin.members')->with('Success', 'Member berhasil diperbaharui!');
        } else {
            return redirect()->back()->with('Error', 'Telah terjadi kesalahan, silahkan hubungi administrator!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('admin.members')->with('Success', 'Member berhasil dihapus!');
    }
}
