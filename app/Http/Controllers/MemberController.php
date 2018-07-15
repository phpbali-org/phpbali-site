<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\User;
use DB;
use Image;
use File;
use Hash;
use DataTables;

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
     * Display a view page of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = User::where('verified', '1')->count();
        return view('backendViews.admin.members.index')

        ->with('members', $members);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jsonIndex()
    {
        $members = User::query();
        $data = DataTables::eloquent($members)
            ->filter(function($query) {
                $query->where('verified', 1);
            })
            ->addColumn('status', function(User $member) {
                if($member->is_staff == 1){
                    return 'Yes';
                }else{
                    return 'No';
                }
            })
            ->addColumn('action', function(User $member) {
                return '
                    <a href="'.route("admin.members.edit", ["slug" => $member->slug]).'">Edit</a> | <a href="#" data-href="'.route("admin.members.delete", ["slug" => $member->slug]).'" data-toggle="modal" data-target="#modal-action">Delete</a>
                ';
            })
            ->addIndexColumn()
            ->toJson();
        return $data;
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
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('Error', $validator->errors()->first());
        }

        if($request->has('photos'))
        {
            //Process the image data
            $validatorImg = Validator::make($request->all(), [
                'img_event' => 'mimes:jpg,png,jpeg|max:2048'
            ]);
            if ($validatorImg->fails()) {
                return redirect()->back()->with('Error', $validatorImg->errors()->first());
            }
            $img = $request->file('photos');
            $photos = str_slug($request->name).'.'.$img->getClientOriginalExtension();
            $imgFile = Image::make($img);

            // Check dulu apakah img sudah ada
            if (File::exists(public_path().'/img/avatar/'.$photos)) {
                File::delete(public_path().'/img/avatar/'.$photos);
            }

            //simpan img
            $imgFile->save('img/avatar/'.$photos, 85); //tidak lupa di compress jg
        }else{
            $photos = 'default-avatar.png';
        }

        $checker = User::where('email', $request->email)->count();
        if($checker < 1)
        {
            $store = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'slug' => str_slug($request->name),
                'photos' => $photos,
                'password' => Hash::make($request->password),
                'is_staff' => $request->is_staff,
                'verified' => self::VERIFIED
            ]);
        }else{
            return redirect()->back()->with('Error', 'User tersebut telah terdaftar!');
        }

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
        if(isset($member->verify_token))
        {
            $editable = false;
        }else{
            $editable = true;
        }

        return view('backendViews.admin.members.edit')
        ->with('member', $member)
        ->with('general_options', $generalOptions)
        ->with('editable', $editable);
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

        $user = User::where('id', $id)->first();

        if(!isset($user->verify_token))
        {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('Error', $validator->errors()->first());
            }

            if($request->has('photos'))
            {
                //Process the image data
                $validatorImg = Validator::make($request->all(), [
                    'img_event' => 'mimes:jpg,png,jpeg|max:2048'
                ]);
                if ($validatorImg->fails()) {
                    return redirect()->back()->with('Error', $validator->errors()->first());
                }
                $img = $request->file('photos');
                $photos = str_slug($request->name).'.'.$img->getClientOriginalExtension();
                $imgFile = Image::make($img);

                // Check dulu apakah img sudah ada
                if (File::exists(public_path().'/img/avatar/'.$photos)) {
                    File::delete(public_path().'/img/avatar/'.$photos);
                }

                //simpan img
                $imgFile->save('img/avatar/'.$photos, 85); //tidak lupa di compress jg
            }else{
                $photos = $user->photos; // ambil gambar yg terpasang saat ini
            }

            $checker = User::where('email', $request->email)->where('id', '<>', $id)->count();
            if($checker < 1)
            {
                if($request->has('password'))
                {
                    $update = User::where('id', $id)->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'slug' => str_slug($request->name),
                        'photos' => $photos,
                        'password' => Hash::make($request->password),
                        'is_staff' => $request->is_staff,
                        'verified' => self::VERIFIED
                    ]);
                }else{
                    $update = User::where('id', $id)->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'slug' => str_slug($request->name),
                        'photos' => $photos,
                        'is_staff' => $request->is_staff,
                        'verified' => self::VERIFIED
                    ]);
                }
            }else{
                return redirect()->back()->with('Error', 'User dengan email tersebut telah terdaftar!');
            }
        }else{
            $update = $user->update(['is_staff' => $request->is_staff]);
        }

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
