@extends('layouts.app')

@section('style')
    @include('components.snackbar.style')
@endsection

@section('content')
    @include('components.event.detail', [
        'event' => $event,
        'topics' => $topics
    ])

    <div class="flex flex-col items-end fixed z-1000" style="bottom: 24px; right: 24px;">
        @include('components.fab-action', [
            'event' => $event
        ])
    </div>

    {{-- Snackbar --}}
    <div id="snackbar"></div>
@endsection

@section('script')
    @include('components.participant.script', [
        'event' => $event,
    ])

    @include('components.topic.script')
@endsection
