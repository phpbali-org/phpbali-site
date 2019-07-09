@extends('layouts.app')

@section('plugins.css')
    <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">
@endsection

@section('plugins.js')
    <script src="{{ asset('js/flatpickr.js') }}" async></script>
@endsection

@section('content')
    <div class="w-full max-w-full m-auto">
      <form class="rounded px-8 pt-6 pb-8 mb-4" method="post" action="{{ $event->path() . "/update" }}">
        @method('PUT')
        @include('components.event.form', [
            'event' => $event,
        ])
      </form>
    </div>
@endsection

@section('script')
<script>
// Detect if a document has loaded with JavaScript
document.onreadystatechange = function () {
    if (document.readyState === 'complete') {
        flatpickr("#eventStartDateTime", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true
        });

        flatpickr("#eventEndDateTime", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true
        });
    }
}
</script>
@endsection
