<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Validator;
use App\Topics;
use App\User;
use App\Events;
use DB;
use Carbon\Carbon;

class TopicController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topics::where('deleted', 0)->paginate(15);
        return view('backendViews.admin.topics.index')
        ->with('topics', $topics);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $events = Events::where('deleted', 0)->get();
        return view('backendViews.admin.topics.add')
        ->with('users', $users)
        ->with('events', $events);
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
            'title' => 'required',
            'id_event' => 'required',
            'id_user' => 'required',
            'desc' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('Error', 'Pastikan anda mengisi seluruh field yang diminta!');
        }

        $checker = Topics::where('title', $request->title)->where('deleted',  0)->count();
        if ($checker > 0) {
            return redirect()->back()->with('Error', 'Topik tersebut sudah ada, silahkan inputkan topik yang belum ada!');
        } else {
            $data = [
                'slug' => str_slug($request->title, '-'),
                'title' => $request->title,
                'id_event' => $request->id_event,
                'desc' => $request->desc
            ];

            $execute = Topics::create($data);

            if ($execute) {
                $id_topic = Topics::find($execute->id);
                $id_topic->speakers()->sync($request->get('id_user'));

                return redirect()->route('admin.topic')->with('Success', 'Topik berhasil dibuat!');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  String  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $topic = Topics::where('slug', $slug)->where('deleted', 0)->first();

        $selected_user_id = array();

        //dapatkan selected user
        foreach ($topic->speakers as $speaker) {
            array_push($selected_user_id, $speaker->id);
        }

        $users = User::all();
        $events = Events::where('deleted', 0)->get();

        return view('backendViews.admin.topics.edit')
        ->with('topic', $topic)
        ->with('users', $users)
        ->with('selected_user_id', $selected_user_id)
        ->with('events', $events);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  String  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'id_event' => 'required',
            'id_user' => 'required',
            'desc' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('Error', 'Pastikan anda mengisi seluruh field yang diminta!');
        }

        $checker = Topics::where('title', $request->title)->where('slug', '<>', $slug)->where('deleted',  0)->count();
        if ($checker > 0) {
            return redirect()->back()->with('Error', 'Topik tersebut sudah ada, silahkan inputkan topik yang belum ada!');
        } else {
            $data = [
                'slug' => str_slug($request->title, '-'),
                'title' => $request->title,
                'id_event' => $request->id_event,
                'desc' => $request->desc
            ];

            $execute = Topics::where('slug', $slug)->update($data);

            if ($execute) {
                $id_topic = Topics::where('slug', str_slug($request->title, '-'))->first();
                $id_topic->speakers()->sync($request->get('id_user'));

                return redirect()->route('admin.topic')->with('Success', 'Topik berhasil diedit!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  String  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $data = ['deleted' => 1];
        $execute = Topics::where('slug', $slug)->update($data);

        return redirect()->route('admin.topic')->with('Success', 'Topik berhasil dihapus!');
    }
}
