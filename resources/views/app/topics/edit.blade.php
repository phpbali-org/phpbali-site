@extends('layouts.app')

@section('plugins.css')
    <link rel="stylesheet" href="{{ asset('css/choices.min.css') }}">
@endsection

@section('plugins.js')
    <script src="{{ asset('js/choices.min.js') }}" async></script>
@endsection

@section('content')
    <div class="w-full max-w-full m-auto">
        <form class="rounded px-8 pt-6 pb-8 mb-4" method="post" action="{{ route('topic.update', ['event' => $event, 'topic' => $topic]) }}">
            @method('PUT')
            @include('components.topic.form', [
                'topic' => $topic,
                'users' => $users,
                'speakers' => $topic->speakers()->get()->map(function ($speaker) {
                    return $speaker->id;
                }),
            ])
        </form>
    </div>
@endsection

@section('script')
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
@endsection
