@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/choices.min.css') }}">
@endpush

@section('content')
    @include('components.topic.form', [
        'topic' => $topic,
        'users' => $users,
        'speakers' => $topic->speakers()->get()->map(function ($speaker) {
            return $speaker->id;
        }),
        'action' => route('topic.update', ['event' => $event, 'topic' => $topic]),
        '_method' => 'PUT'
    ])
@endsection

@push('script')
<script src="{{ asset('js/choices.min.js') }}"></script>
<script>
new Choices('#topicSpeaker', {
    removeItemButton: true,
});
</script>
@endpush
