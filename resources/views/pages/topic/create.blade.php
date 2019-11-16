@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/choices.min.css') }}">
@endpush

@prepend('script')
    <script src="{{ asset('js/choices.min.js') }}" async></script>
@endprepend

@section('content')
    <div class="w-full max-w-full m-auto">
        <form class="rounded px-8 pt-6 pb-8 mb-4" method="post" action="{{ $event->path() . "/topics/store" }}">
            @include('components.topic.form', [
                'topic' => new \App\Models\Topic,
                'users' => $users,
                'speakers' => collect([]),
            ])
        </form>
    </div>
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
