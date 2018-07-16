<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;
use Image;
use File;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $className = 'profile-page';
        $user = Auth::guard('web')->user();
        return view('profile.index')
        ->with('user', $user)
        ->with('class-name', $className);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::guard('web')->user();
        return view('profile.edit')
        ->with('user', $user);
    }

    public function update(Request $request) {
        $validator = Validator::make($data, [
            'name'  => 'required|string',
            'email' => 'required|unique:users,email,'.Auth::guard('web')->user()->id,
        ]);
        if($validator->fails()){
            return redirect()->back()->with([
                'status'=>'error',
                'header'=>'Oops! Something went wrong!',
                'msg' => $validator->errors()->first(),
            ]);
        }
        $update = Auth::guard('web')->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'about' => $request->about
        ]);
        if($update) {
            return redirect()->back()->with([
                'status'=>'success',
                'header'=>'Operation Success!',
                'msg' => 'Your profile successfully edited!',
            ]);
        }
    }

    public function updateavatar(Request $request) {
        $validator = Validator::make($request->all(), [
            'photos' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if($validator->fails()){
            return redirect()->back()->with([
                'status'=>'error',
                'header'=>'Oops! Something went wrong!',
                'msg' => $validator->errors()->first(),
            ]);
        }

        $imagePath = $request->photos;
        $fileName = str_slug(Auth::user()->email).time().'.'.$imagePath->getClientOriginalExtension();
        $resizedImage = Image::make($imagePath)->resize(150, null, function($constrait) {
            $constrait->aspectRatio();
        });

        // Check dulu apakah img sudah ada
        if (File::exists(public_path().'/img/avatar/'.$fileName)) {
            File::delete(public_path().'/img/avatar/'.$fileName);
        }

        //simpan img
        $resizedImage->save('img/avatar/'.$fileName, 85); //tidak lupa di compress jg

        //kirim nama file ke database
        $storeImg = Auth::guard('web')->user()->update(['photos' => $fileName]);

        if($storeImg) {
            return redirect()->back()->with([
                'status'=>'success',
                'header'=>'Operation Success!',
                'msg' => 'Your avatar profile successfully updated!',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function member(Request $request, $slug)
    {
        if(isset($slug)) {
            $user = User::where('slug',$slug)->first();
            return view('profile.index')
            ->with('user', $user);
        }else {
            return abort(404);
        }
    }

    public function allmember() {
        $member = User::where('verified', 1)->orderBy('name','asc')->get();
        return view('member',['member'=>$member]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
