@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">
@endpush

@section('content')
    @include('components.event.form', [
        'event' => new \App\Models\Event,
        'action' => "/events/store"
    ])
@endsection

@push('script')
<script src="{{ asset('js/flatpickr.js') }}"></script>
<script>
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
</script>
@endpush
