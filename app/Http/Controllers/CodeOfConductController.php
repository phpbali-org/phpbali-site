<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conduct;
use Validator;

class CodeOfConductController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
    	$conduct = Conduct::first();

    	return view('backendViews.admin.conduct.index')
    	->with('conduct', $conduct);
    }

    public function saveChanges(Request $request)
    {
    	$validator = Validator::make($request->all(), [
    		'desc' => 'required'
    	]);

    	if($validator->fails())
    	{
    		return redirect()->back()->with('Error', $validator->errors()->first());
    	}

    	$checker = Conduct::count();

    	if($checker < 1)
    	{
    		$data = ['desc' => $request->desc];

    		$execute = Conduct::create($data);

    		if($execute)
    		{
    			return redirect()->back()->with('Success', 'Code of Conduct telah berhasil dibuat!');
    		}else{
    			return redirect()->back()->with('Error', 'Terdapat kesalahan! Silahkan hubungi pihak administrator');
    		}
    	}else{
    		$data = ['desc' => $request->desc];

    		$execute = Conduct::where('id', 1)->update($data);

    		if($execute)
    		{
    			return redirect()->back()->with('Success', 'Code of Conduct telah berhasil diubah!');
    		}else{
    			return redirect()->back()->with('Error', 'Terdapat kesalahan! Silahkan hubungi pihak administrator');
    		}
    	}
    }
}
