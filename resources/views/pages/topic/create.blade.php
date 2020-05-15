@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/choices.min.css') }}">
@endpush

@section('content')
    @include('components.topic.form', [
        'topic' => new \App\Models\Topic,
        'users' => $users,
        'speakers' => collect([]),
        'action' => $event->path() . "/topics/store"
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
