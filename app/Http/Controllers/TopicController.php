<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Topic;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Validator;

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
        $topics = Topic::count();

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
                    <a href="'.route('admin.topic.edit', ['slug' => $topic->slug]).'">Edit</a> | <a href="#" data-href="'.route('admin.topic.delete', ['slug' => $topic->slug]).'" data-toggle="modal" data-target="#modal-action">Delete</a>
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
        $events = Event::get();

        return view('backendViews.admin.topics.add')
        ->with('users', $users)
        ->with('events', $events);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'    => 'required',
            'id_event' => 'required',
            'id_user'  => 'required',
            'desc'     => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('Error', $validator->errors()->first());
        }

        $checker = Topic::where('title', $request->title)->count();
        if ($checker > 0) {
            return redirect()->back()->with('Error', 'Topik tersebut sudah ada, silahkan inputkan topik yang belum ada!');
        } else {
            $execute = Topic::create([
                'slug'     => str_slug($request->title, '-'),
                'title'    => $request->title,
                'event_id' => $request->id_event,
                'desc'     => $request->desc,
            ]);

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
     * @param string $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $topic = Topic::where('slug', $slug)->first();

        $selected_user_id = [];

        //dapatkan selected user
        foreach ($topic->speakers as $speaker) {
            array_push($selected_user_id, $speaker->id);
        }

        $users = User::all();
        $events = Event::get();

        return view('backendViews.admin.topics.edit')
        ->with('topic', $topic)
        ->with('users', $users)
        ->with('selected_user_id', $selected_user_id)
        ->with('events', $events);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string                   $slug
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $validator = Validator::make($request->all(), [
            'title'    => 'required',
            'id_event' => 'required',
            'id_user'  => 'required',
            'desc'     => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('Error', $validator->errors()->first());
        }

        $checker = Topic::where('title', $request->title)->where('slug', '<>', $slug)->count();
        if ($checker > 0) {
            return redirect()->back()->with('Error', 'Topik tersebut sudah ada, silahkan inputkan topik yang belum ada!');
        } else {
            $execute = Topic::where('slug', $slug)->update([
                'slug'     => str_slug($request->title, '-'),
                'title'    => $request->title,
                'event_id' => $request->id_event,
                'desc'     => $request->desc,
            ]);

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
     * @param string $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        Topic::where('slug', $slug)->delete();

        return redirect()->route('admin.topic')->with('Success', 'Topik berhasil dihapus!');
    }
}
