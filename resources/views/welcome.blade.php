@extends('layouts.app')

@section('style')

@endsection

@section('content')
    <div class="my-8 mx-auto">
        <div class="text-center">
            <h1 class="text-3xl font-bold mb-4">
                {{ $event->name }}
            </h1>

            <div class="my-4">
                <div class="uppercase tracking-wide text-sm text-indigo-600 font-bold">
                    <time>{{ $event->eventDate() }} {{ $event->eventTime() }}</time>
                </div>
                <address class="mt-2 text-gray-600 mx-4">
                    <strong>{{ $event->place_name }}</strong> . {{ $event->address }}
                </address>
            </div>
        </div>

        <p class="text-justify break-words mx-4">{{ $event->desc }}</p>
    </div>

    <div class="mt-8">
        <h1 class="text-3xl mb-4 text-center">TOPIK</h1>
        <hr class="my-8 border-b-2 border-gray-200 w-3/4 md:w-1/2">

        <div class="flex flex-col items-center">
            @foreach ($topics as $topic)
                <div class="rounded-lg overflow-hidden border border-gray-400 p-4 p-8 m-4 md:w-3/4">
                    <div class="md:flex">
                        <div class="mt-4 md:mt-0 md:ml-6">
                            <div class="uppercase tracking-wide text-sm text-indigo-600 font-bold">
                                {{ $topic->title }}
                            </div>
                            <p class="mt-2 text-black">{{ $topic->desc }}</p>
                                <ul class="flex flex-wrap items-center mt-4">
                                    @foreach ($topic->speakers()->get() as $speaker)
                                        <li class="flex items-center md:w-1/2">
                                            <img src="{{ $speaker->avatar() }}" alt="Speaker's avatar" class="rounded-full md:w-16 max-w-xs my-4" width="50">
                                            <div class="mt-0 mx-4">
                                                <p class="">{{ $speaker->name }}</p>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- <div class="mt-8"> --}}
        {{-- <h1 class="text-3xl mb-4 text-center">PARTISIPAN</h1> --}}
        {{-- <hr class="my-8 border-b-2 border-gray-200 w-3/4 md:w-1/2"> --}}
        {{-- Jika user telah mendaftar dan kegiatan belum berlangsung maka kalimatnya: "X orang telah mendaftar"
        Jika user telah hadir dan kegiatan sedang/sudah berlangsung maka kalimatnya: "X orang telah hadir" --}}
        {{-- @if ($event->isOngoing() || $event->hasFinished()) --}}
            {{-- @if (empty($attended_count)) --}}
                {{-- <p class="text-center text-2xl font-bold m-8">Belum ada yang hadir. Cepat datang!</p> --}}
            {{-- @else --}}
                {{-- <div class="text-center my-8"> --}}
                    {{-- <p class="text-4xl font-bold">{{ $attended_count }}</p> --}}
                    {{-- <p>Orang telah hadir</p> --}}
                {{-- </div> --}}
            {{-- @endif --}}
        {{-- @else --}}
            {{-- <div class="text-center my-8"> --}}
                {{-- <p class="text-4xl font-bold">{{ $reservation_count }}</p> --}}
                {{-- <p>Orang telah mendaftar</p> --}}
            {{-- </div> --}}

            {{-- <h2 class="text-2xl text-center mt-8">Silahkan daftar di sini!</h2> --}}
            {{-- Tampilkan form ini jika kegiatan belum berlangsung --}}
            {{-- <div class="flex justify-center m-4"> --}}
                {{-- <div class="w-full md:w-1/2"> --}}
                    {{-- <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="/register" method="post"> --}}
                        {{-- @csrf --}}
                        {{-- <input type="hidden" name="event_id" value="{{ $event->id }}"> --}}
                        {{-- <div class="mb-4"> --}}
                            {{-- <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Nama</label> --}}
                            {{-- <input type="text" id="name" name="name_of_registrant" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline focus:shadow-outline" value="{{ old('name_of_registrant') }}" placeholder="Nama" required> --}}
                        {{-- </div> --}}
                        {{-- <div class="mb-6"> --}}
                            {{-- <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label> --}}
                            {{-- <input type="email" id="email" name="registrant_email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline focus:shadow-outline" value="{{ old('registrant_email') }}" placeholder="Email" required> --}}
                        {{-- </div> --}}
                        {{-- <div class="flex"> --}}
                            {{-- <button type="button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Daftar</button> --}}
                        {{-- </div> --}}
                    {{-- </form> --}}
                {{-- </div> --}}
            {{-- </div> --}}
        {{-- @endif --}}
    {{-- </div> --}}
@endsection

@section('script')

@endsection
