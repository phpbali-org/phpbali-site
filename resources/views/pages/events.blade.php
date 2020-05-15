@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('css/snackbar.css') }}">
@endpush

@section('content')
    <div class="my-16">
        <h1 class="text-center text-3xl mt-4 font-bold">DAFTAR KEGIATAN</h1>
        <hr class="my-8 border-b-2 border-gray-300 w-1/2 m-auto">
        <div class="flex flex-col m-auto justify-center items-center md:w-3/4">
            @foreach ($events as $event)
                @include('components.event.card', ['event' => $event])
            @endforeach
        </div>

        @if (auth()->check() && auth()->user()->isAdmin())
        <div class="flex flex-col align-end fixed z-1000" style="bottom: 24px; right: 24px;">
            <a href="events/create" class="relative rounded-full shadow border bg-white hover:bg-gray-100 text-gray-800 border-gray-400 py-4 px-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="fill-current w-5 h-5">
                    <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
                </svg>
            </a>
        </div>
        @endif
    </div>

    {{-- Snackbar --}}
    <div id="snackbar"></div>

    @include('components.modal')
@endsection

@push('script')
<script src="{{ asset('js/dialog.js') }}"></script>
@endpush
