@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/choices.min.css') }}">
@endpush

@prepend('script')
    <script src="{{ asset('js/choices.min.js') }}" async></script>
@endprepend

@section('content')
    @include('components.topic.form', [
        'topic' => new \App\Models\Topic,
        'users' => $users,
        'speakers' => collect([]),
        'action' => $event->path() . "/topics/store"
    ])
@endsection

@push('script')
<script>
// Detect if a document has loaded with JavaScript
document.onreadystatechange = function () {
    if (document.readyState === 'complete') {
        new Choices('#topicSpeaker', {
            removeItemButton: true,
        });
    }
}
</script>
@endpush
