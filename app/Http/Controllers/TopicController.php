<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Topic;
use App\Models\User;
use App\Models\Event;
use DataTables;

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
     * Display a view page of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topics = Topic::where('deleted', 0)->count();
        return view('backendViews.admin.topics.index')
        ->with('topics', $topics);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function jsonIndex()
    {
        $topics = Topic::query();
        $data = DataTables::eloquent($topics)
            ->filter(function ($query) {
                $query->where('deleted', 0);
            })
            ->addColumn('speakers', function (Topic $topic) {
                $speakers = [];
                foreach ($topic->speakers as $speaker) {
                    $speakers[] = $speaker->name;
                }
                return implode(',', $speakers);
            })
            ->addColumn('event', function (Topic $topic) {
                return $topic->event->name;
            })
            ->addColumn('action', function (Topic $topic) {
                return '
                    <a href="'.route("admin.topic.edit", ["slug" => $topic->slug]).'">Edit</a> | <a href="#" data-href="'.route("admin.topic.delete", ["slug" => $topic->slug]).'" data-toggle="modal" data-target="#modal-action">Delete</a>
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
        $users = User::all();
        $events = Event::where('deleted', 0)->get();
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
            return redirect()->back()->with('Error', $validator->errors()->first());
        }

        $checker = Topic::where('title', $request->title)->where('deleted', 0)->count();
        if ($checker > 0) {
            return redirect()->back()->with('Error', 'Topik tersebut sudah ada, silahkan inputkan topik yang belum ada!');
        } else {
            $data = [
                'slug' => str_slug($request->title, '-'),
                'title' => $request->title,
                'event_id' => $request->id_event,
                'desc' => $request->desc
            ];

            $execute = Topic::create($data);

            if ($execute) {
                $topic = Topic::find($execute->id);
                $topic->speakers()->sync($request->get('id_user'));

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
        $topic = Topic::where('slug', $slug)->where('deleted', 0)->first();

        $selected_user_id = array();

        //dapatkan selected user
        foreach ($topic->speakers as $speaker) {
            array_push($selected_user_id, $speaker->id);
        }

        $users = User::all();
        $events = Event::where('deleted', 0)->get();

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
            return redirect()->back()->with('Error', $validator->errors()->first());
        }

        $checker = Topic::where('title', $request->title)->where('slug', '<>', $slug)->where('deleted', 0)->count();
        if ($checker > 0) {
            return redirect()->back()->with('Error', 'Topik tersebut sudah ada, silahkan inputkan topik yang belum ada!');
        } else {
            $data = [
                'slug' => str_slug($request->title, '-'),
                'title' => $request->title,
                'event_id' => $request->id_event,
                'desc' => $request->desc
            ];

            $execute = Topic::where('slug', $slug)->update($data);

            if ($execute) {
                $topic = Topic::where('slug', str_slug($request->title, '-'))->first();
                $topic->speakers()->sync($request->get('id_user'));

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
        $execute = Topic::where('slug', $slug)->update($data);

        return redirect()->route('admin.topic')->with('Success', 'Topik berhasil dihapus!');
    }
}
