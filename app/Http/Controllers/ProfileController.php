<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use App\User;
use Auth;
use Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('profile') && $request->has('member')) {
            $id = $request->get('profile');
            $className = 'profile-page';
            $user = User::where('id',$id)->first();
            return view('profile.index',['user'=>$user,'class-name'=>$className]);
        }else {
            return redirect('/');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if($request->has('profile') && $request->has('member')) {
            $id = $request->get('profile');
            $user = User::where('id',$id)->first();
            return view('profile.edit',['user'=>$user]);
        }else {
            return abort(404);
        }
    }

    public function update(Request $request) {
        $this->validateUpdate($request->all())->validate();

        event(new Registered($user = $this->processUpdate($request->all())));

        return redirect()->back()->with(['status'=>'Data Updated!','header'=>'Good Job!']);
    }

    protected function validateUpdate(array $data) {
        return Validator::make($data, [
            'name'  => 'required|string',
            'email' => 'required|unique:users,email,'.Auth::user()->id,
            'about' => 'required|string'
        ]);
    }

    protected function processUpdate(array $data) {
        $user = User::where('id',Auth::user()->id)
                ->update([
                    'name'  => $data['name'],
                    'email' => $data['email'],
                    'website'   => $data['website'],
                    'about'     => $data['about']
                ]);
        return $user;
    }

    // update avatar
    public function updateavatar(Request $request) {
        $this->validateImage($request->all())->validate();
        $photos = $this->uploadImage($request->file('photos'));

        $user = User::findOrFail(Auth::user()->id);
        $user->photos = $photos;
        $user->save();

        return redirect()->back()->with(['status'=>'Avatar Updates','header'=>'Good Job!']);
    }

    protected function validateImage(array $data) {
        return Validator::make($data, [
            'photos'    => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
    }

    protected function uploadImage($file) {
        $image = $file;
        $fileName = str_slug(Auth::user()->name).time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/img/avatar');;
        $img = Image::make($image->getRealPath());
        $img->resize(150, null, function($constrait) {
            $constrait->aspectRatio();
        })->save($destinationPath.'/'.$fileName, 85);

        return $fileName;
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
        if($slug) {
            $member = User::where('slug',$slug)->first();
            return view('profile.index',['user'=>$member]);
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
