@extends('layouts.app')

@section('content')
    @foreach ($previous_events as $previous_event)
        <div style="margin: 1rem; padding: 1rem;">
            <time>{{ $previous_event->eventDate() }} {{ $previous_event->eventTime() }}</time>
            <h2>{{ $previous_event->name }}</h2>
            <address>
                <strong>{{ $previous_event->place_name }}</strong> . {{ $previous_event->address }}
            </address>
        </div>
    @endforeach
@endsection
