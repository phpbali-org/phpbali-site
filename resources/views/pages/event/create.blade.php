@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">
@endpush

@prepend('script')
    <script src="{{ asset('js/flatpickr.js') }}" async></script>
@endprepend

@section('content')
    @include('components.event.form', [
        'event' => new \App\Models\Event,
        'action' => "/events/store"
    ])
@endsection

@push('script')
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
@endpush
