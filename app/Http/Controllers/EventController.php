<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Topics;
use App\User;
use App\Events;
use DB;
use Carbon\Carbon;

class EventController extends Controller
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
        $events = Events::where('deleted', 0)->paginate(15);
        return view('backendViews.admin.events.index')
        ->with('events', $events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backendViews.admin.events.add');
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
            'desc' => 'required',
            'tanggal_acara_start_date' => 'required',
            'waktu_acara_start_date' => 'required',
            'tanggal_acara_end_date' => 'required',
            'waktu_acara_end_date' => 'required',
            'place' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('Error', 'Pastikan anda mengisi seluruh field yang diminta!');
        }

        $checker = Events::where('name', $request->name)->where('deleted',  0)->count();
        if ($checker > 0) {
            return redirect()->back()->with('Error', 'Judul tersebut sudah digunakan, silahkan inputkan judul yang belum digunakan!');
        } else {
            //gathering data
            $start_date = Carbon::createFromFormat('d/M/Y H:i A', $request->tanggal_acara_start_date.' '.$request->waktu_acara_start_date);
            $end_date = Carbon::createFromFormat('d/M/Y H:i A', $request->tanggal_acara_end_date.' '.$request->waktu_acara_end_date);
            $slug = str_slug($request->name, '-');
            if ($request->has('published')) {
                $published = $request->published;
            } else {
                $published = 0;
            }
            $data = [
                'name' => $request->name,
                'slug' => $slug,
                'desc' => $request->desc,
                'start_date' => date('Y-m-d H:i:s', strtotime($start_date)),
                'end_date' => date('Y-m-d H:i:s', strtotime($end_date)),
                'place' => $request->place,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'published' => $published
            ];

            //process data
            $execute = Events::create($data);

            if ($execute) {
                return redirect()->route('admin.event')->with('Success', 'Event telah berhasil di buat, jangan lupa untuk membuat topic nya juga!');
            } else {
                return redirect()->back()->with('Error', 'Telah terjadi kesalahan, silahkan hubungi administrator!');
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
        $event = Events::where('slug', $slug)->where('deleted', 0)->first();

        $tanggal_acara_start_date = date('d/M/Y', strtotime($event->start_date));
        $tanggal_acara_end_date = date('d/M/Y', strtotime($event->end_date));
        $waktu_acara_start_date = date('H:i A', strtotime($event->start_date));
        $waktu_acara_end_date = date('H:i A', strtotime($event->end_date));

        return view('backendViews.admin.events.edit')
        ->with('event', $event)
        ->with('tanggal_acara_start_date', $tanggal_acara_start_date)
        ->with('tanggal_acara_end_date', $tanggal_acara_end_date)
        ->with('waktu_acara_start_date', $waktu_acara_start_date)
        ->with('waktu_acara_end_date', $waktu_acara_end_date);
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
            'name' => 'required',
            'desc' => 'required',
            'tanggal_acara_start_date' => 'required',
            'waktu_acara_start_date' => 'required',
            'tanggal_acara_end_date' => 'required',
            'waktu_acara_end_date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('Error', 'Pastikan anda mengisi seluruh field yang diminta!');
        }

        $checker = Events::where('name', $request->name)->where('slug', '<>', $slug)->where('deleted',  0)->count();
        if ($checker > 0) {
            return redirect()->back()->with('Error', 'Judul tersebut sudah digunakan, silahkan inputkan judul yang belum digunakan!');
        } else {
            //gathering data
            $start_date = Carbon::createFromFormat('d/M/Y H:i A', $request->tanggal_acara_start_date.' '.$request->waktu_acara_start_date);
            $end_date = Carbon::createFromFormat('d/M/Y H:i A', $request->tanggal_acara_end_date.' '.$request->waktu_acara_end_date);
            $slug = str_slug($request->name, '-');
            if ($request->has('published')) {
                $published = $request->published;
            } else {
                $published = 0;
            }
            if (isset($request->place) && isset($request->latitude) && isset($request->longitude)) {
                $data = [
                    'name' => $request->name,
                    'slug' => $slug,
                    'desc' => $request->desc,
                    'start_date' => date('Y-m-d H:i:s', strtotime($start_date)),
                    'end_date' => date('Y-m-d H:i:s', strtotime($end_date)),
                    'place' => $request->place,
                    'latitude' => $request->latitude,
                    'longitude' => $request->longitude,
                    'published' => $published
                ];
            } else {
                $data = [
                    'name' => $request->name,
                    'slug' => $slug,
                    'desc' => $request->desc,
                    'start_date' => date('Y-m-d H:i:s', strtotime($start_date)),
                    'end_date' => date('Y-m-d H:i:s', strtotime($end_date)),
                    'published' => $published
                ];
            }

            //process data
            $execute = Events::where('slug', $slug)->update($data);

            if ($execute) {
                return redirect()->route('admin.event')->with('Success', 'Event telah berhasil diedit');
            } else {
                return redirect()->back()->with('Error', 'Telah terjadi kesalahan, silahkan hubungi administrator!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  String  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $data = ['deleted' => 1];
        $execute = Events::where('slug', $slug)->update($data);
        if ($execute) {
            return redirect()->route('admin.event')->with('Success', 'Event telah berhasil dihapus!');
        } else {
            return redirect()->back()->with('Error', 'Telah terjadi kesalahan, silahkan hubungi administrator!');
        }
    }
}
