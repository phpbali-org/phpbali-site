@extends('layouts.app')

@section('style')

@endsection

@section('content')
    <div class="my-8 mx-auto">
        <div class="text-center">
            <h1 class="text-3xl font-bold mb-4" id="eventTitle">
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

        <p class="text-justify break-words mx-4" id="eventDesc">{{ $event->desc }}</p>
    </div>

    <div class="mt-8">
        <h1 class="text-3xl mb-4 text-center">TOPIK</h1>
        <hr class="my-8 border-b-2 border-gray-200 w-3/4 md:w-1/2">

        <div class="flex flex-col items-center">
            @foreach ($topics as $topic)
                @include('components.topic', ['topic' => $topic])
            @endforeach
        </div>
    </div>

    <div class="mt-8">
        <h1 class="text-3xl mb-4 text-center">PARTISIPAN</h1>
        <hr class="my-8 border-b-2 border-gray-200 w-3/4 md:w-1/2">
        @if (auth()->check() && (auth()->user()->isStaff() || auth()->user()->isAdmin()))
            <div class="flex flex-col items-center">
                @foreach ($event->reservations()->get() as $participant)
                    @include('components.participant', ['participant' => $participant])
                @endforeach
            </div>
        @else
            {{-- Jika user telah mendaftar dan kegiatan belum berlangsung maka kalimatnya: "X orang telah mendaftar"
            Jika user telah hadir dan kegiatan sedang/sudah berlangsung maka kalimatnya: "X orang telah hadir" --}}
            @if ($event->isOngoing() || $event->hasFinished())
                @if (empty($attended_count))
                    <p class="text-center text-2xl font-bold m-8">Belum ada yang hadir. Cepat datang!</p>
                @else
                    <div class="text-center my-8">
                        <p class="text-4xl font-bold">{{ $attended_count }}</p>
                        <p>Orang telah hadir</p>
                    </div>
                @endif
            @else
                <div class="text-center my-8">
                    <p class="text-4xl font-bold">{{ $reservation_count }}</p>
                    <p>Orang telah mendaftar</p>
                </div>
                {{-- Cek apakah user sudah mendaftar atau belum --}}
                @if (auth()->check())
                    @if ($event->reservations()->where('user_id', auth()->user()->id)->get()->isEmpty())
                        <h2 class="text-2xl text-center mt-8">Silahkan daftar di sini!</h2>
                        {{-- Tampilkan form ini jika kegiatan belum berlangsung --}}
                        <div class="flex flex-col items-center m-4">
                            <form action="{{ $event->path() . "/register" }}" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                @csrf
                                <button type="submit" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow mb-4">Daftar</button>
                            </div>
                        </div>
                    @endif
                @else
                    <h2 class="text-2xl text-center mt-8">Silahkan daftar di sini!</h2>
                    {{-- Tampilkan form ini jika kegiatan belum berlangsung --}}
                    <div class="flex flex-col items-center m-4">
                        <a href="/register/github" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow mb-4">Login with Github</a>
                    </div>
                @endif
            @endif
        @endif
    </div>
    <div class="flex flex-col items-end fixed z-1000" style="bottom: 24px; right: 24px;">
        <button type="button" id="shareBtn" class="relative rounded-full shadow border bg-white hover:bg-gray-100 text-gray-800 border-gray-400 p-4 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="fill-current w-8 h-8">
                <path d="M352 320c-22.608 0-43.387 7.819-59.79 20.895l-102.486-64.054a96.551 96.551 0 0 0 0-41.683l102.486-64.054C308.613 184.181 329.392 192 352 192c53.019 0 96-42.981 96-96S405.019 0 352 0s-96 42.981-96 96c0 7.158.79 14.13 2.276 20.841L155.79 180.895C139.387 167.819 118.608 160 96 160c-53.019 0-96 42.981-96 96s42.981 96 96 96c22.608 0 43.387-7.819 59.79-20.895l102.486 64.054A96.301 96.301 0 0 0 256 416c0 53.019 42.981 96 96 96s96-42.981 96-96-42.981-96-96-96z"/>
            </svg>
        </btn>
    </div>
@endsection

@section('script')
<script>
    const title = document.getElementById('eventTitle').textContent.trim();
    const text = document.getElementById('eventDesc').textContent.trim();
    const url = document.querySelector('link[rel=canonical]') && document.querySelector('link[rel=canonical]').href || window.location.href;
    document.getElementById('shareBtn').addEventListener('click', () => {
        if (navigator.share) {
            navigator.share({
                title,
                text,
                url
            })
            .then(() => {
                if (window.ga && ga.create) {
                    ga('send', 'event', 'Button', 'share', 'Share Event PHPBali');
                }
                console.log('Successful share');
            })
            .catch((error) => {
                console.log('Error sharing', error);
            })
        } else {
            console.log('Not supported, sorry');
        }
    });
</script>
@endsection
