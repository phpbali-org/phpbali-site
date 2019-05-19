@extends('layouts.app')

@section('content')
    <h1 class="text-center text-3xl mt-4">KEGIATAN SEBELUMNYA</h1>
    @foreach ($previous_events as $previous_event)
        <div class="rounded-lg overflow-hidden border border-gray-400 p-4 p-8 m-4">
            <div class="md:flex">
                <div class="mt-4 md:mt-0 md:ml-6">
                    <div class="uppercase tracking-wide text-sm text-indigo-600 font-bold">
                        <time>{{ $previous_event->eventDate() }} {{ $previous_event->eventTime() }}</time>
                    </div>
                    <p class="block mt-1 text-lg leading-tight font-semibold text-gray-900">{{ $previous_event->name }}</p>
                    <address class="mt-2 text-gray-600">
                        <strong>{{ $previous_event->place_name }}</strong> . {{ $previous_event->address }}
                    </address>
                </div>
            </div>
        </div>
    @endforeach
@endsection
