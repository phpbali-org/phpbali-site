<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Event;
use Carbon\Carbon;
use Image;
use DataTables;

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
     * Show the index page of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::where('deleted', 0)->get();
        return view('backendViews.admin.events.index', ['events' => $events]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return toJson
     */
    public function jsonIndex()
    {
        $events = Event::query();
        $data = DataTables::eloquent($events)
            ->filter(function ($query) {
                $query->where('deleted', 0);
            })
            ->addColumn('status', function (Event $event) {
                if ($event->published == 1) {
                    return 'Published';
                } else {
                    return 'Not Published';
                }
            })
            ->addColumn('action', function (Event $event) {
                return '
                    <a href="'.route("admin.event.edit", ["slug" => $event->slug]).'">Edit</a> | <a href="#" data-href="'.route("admin.event.delete", ["slug" => $event->slug]).'" data-toggle="modal" data-target="#modal-action">Delete</a>
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
            'img_event' => 'required',
            'mobile_photos' => 'required',
            'tanggal_acara_start_date' => 'required',
            'waktu_acara_start_date' => 'required',
            'tanggal_acara_end_date' => 'required',
            'waktu_acara_end_date' => 'required',
            'place' => 'required',
            'place_name' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('Error', $validator->errors()->first());
        }

        $checker = Event::where('name', $request->name)->where('deleted', 0)->count();
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

            //Process the image data
            $validatorImg = Validator::make($request->all(), [
                'img_event' => 'mimes:jpg,png,jpeg|max:2048',
                'mobile_photos' => 'mimes:jpg,png,jpeg|max:2048',
            ]);

            if ($validatorImg->fails()) {
                return redirect()->back()->with('Error', $validatorImg->errors()->first());
            }

            $webPhoto = $request->img_event;
            $webPhotoName = $slug.'_web.'.$webPhoto->getClientOriginalExtension();
            ;
            $webImgEvent = Image::make($webPhoto->getRealPath());
            $webImgEvent->resize(1024, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $webImgEvent->stream();

            // Check dulu apakah img bg event sudah ada
            if (\Storage::disk('bg-event')->exists($webPhotoName)) {
                \Storage::disk('bg-event')->delete($webPhotoName);
            }

            // Save web img bg event
            $uploadWebImgEvent = \Storage::disk('bg-event')->put($webPhotoName, $webImgEvent, 'public');

            $mobilePhoto = $request->mobile_photos;
            $mobilePhotoName = $slug.'_mobile.'.$mobilePhoto->getClientOriginalExtension();
            $mobileImgEvent = Image::make($mobilePhoto->getRealPath());
            $mobileImgEvent->stream();

            if (\Storage::disk('bg-event')->exists($mobilePhotoName)) {
                \Storage::disk('bg-event')->delete($mobilePhotoName);
            }

            // Save web img bg event
            $uploadMobileImgEvent = \Storage::disk('bg-event')->put($mobilePhotoName, $mobileImgEvent, 'public');

            // Process data
            $execute = Event::create([
                'name' => $request->name,
                'slug' => $slug,
                'desc' => $request->desc,
                'photos' => $webPhotoName,
                'mobile_photos' => $mobilePhotoName,
                'start_date' => date('Y-m-d H:i:s', strtotime($start_date)),
                'end_date' => date('Y-m-d H:i:s', strtotime($end_date)),
                'place' => $request->place,
                'place_name' => $request->place_name,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'published' => $published
            ]);

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
        $event = Event::where('slug', $slug)->where('deleted', 0)->first();

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
            return redirect()->back()->with('Error', $valdiator->errors()->first());
        }

        $checker = Event::where('name', $request->name)->where('slug', '<>', $slug)->where('deleted', 0)->count();
        if ($checker > 0) {
            return redirect()->back()->with('Error', 'Judul tersebut sudah digunakan, silahkan inputkan judul yang belum digunakan!');
        } else {
            // Gathering data

            $start_date = Carbon::createFromFormat('d/M/Y H:i A', $request->tanggal_acara_start_date.' '.$request->waktu_acara_start_date);
            $end_date = Carbon::createFromFormat('d/M/Y H:i A', $request->tanggal_acara_end_date.' '.$request->waktu_acara_end_date);
            $editedSlug = str_slug($request->name, '-');

            if ($request->has('published')) {
                $published = $request->published;
            } else {
                $published = 0;
            }

            $data = [
                'name' => $request->name,
                'slug' => $editedSlug,
                'desc' => $request->desc,
                'start_date' => date('Y-m-d H:i:s', strtotime($start_date)),
                'end_date' => date('Y-m-d H:i:s', strtotime($end_date)),
                'place_name' => $request->place_name,
                'published' => $published,
            ];

            if ($request->has('img_event')) {
                // Process the image data
                $validatorImg = Validator::make($request->all(), [
                    'img_event' => 'mimes:jpg,png,jpeg|max:2048'
                ]);

                if ($validatorImg->fails()) {
                    return redirect()->back()->with('Error', $validatorImg->errors()->first());
                }

                $webPhoto = $request->img_event;
                $webPhotoName = $slug.'_web.'.$webPhoto->getClientOriginalExtension();
                ;
                $webImgEvent = Image::make($webPhoto->getRealPath());
                $webImgEvent->resize(1024, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $webImgEvent->stream();

                // Check dulu apakah img bg event sudah ada
                if (\Storage::disk('bg-event')->exists($webPhotoName)) {
                    \Storage::disk('bg-event')->delete($webPhotoName);
                }

                // Save web img bg event
                $uploadWebImgEvent = \Storage::disk('bg-event')->put($webPhotoName, $webImgEvent, 'public');

                $data['photos'] = $webPhotoName;
            }

            if ($request->has('mobile_photos')) {
                // Process the image data
                $validatorImg = Validator::make($request->all(), [
                    'mobile_photos' => 'mimes:jpg,png,jpeg|max:2048'
                ]);

                if ($validatorImg->fails()) {
                    return redirect()->back()->with('Error', $validatorImg->errors()->first());
                }

                // Mobile photos
                $mobilePhoto = $request->mobile_photos;
                $mobilePhotoName = $slug.'_mobile.'.$mobilePhoto->getClientOriginalExtension();
                $mobileImgEvent = Image::make($mobilePhoto->getRealPath());
                $mobileImgEvent->stream();

                if (\Storage::disk('bg-event')->exists($mobilePhotoName)) {
                    \Storage::disk('bg-event')->delete($mobilePhotoName);
                }

                // Save mobile img bg event
                $uploadMobileImgEvent = \Storage::disk('bg-event')->put($mobilePhotoName, $mobileImgEvent, 'public');

                $data['mobile_photos'] = $mobilePhotoName;
            }

            if ($request->has('place')) {
                $data['place'] = $request->place;
            }

            if ($request->has('latitude')) {
                $data['latitude'] = $request->latitude;
            }

            if ($request->has('longitude')) {
                $data['longitude'] = $request->longitude;
            }

            // Update data
            $execute = Event::where('slug', $slug)->update($data);

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
        $execute = Event::where('slug', $slug)->update($data);
        if ($execute) {
            return redirect()->route('admin.event')->with('Success', 'Event telah berhasil dihapus!');
        } else {
            return redirect()->back()->with('Error', 'Telah terjadi kesalahan, silahkan hubungi administrator!');
        }
    }
}
