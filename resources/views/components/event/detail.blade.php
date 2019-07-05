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
