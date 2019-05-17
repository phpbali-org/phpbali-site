@extends('layouts.app')

@section('style')

@endsection

@section('content')
    <h1>{{ $event->name }}</h1>

    <h2>{{ $event->place_name }}</h2>

    <h3>{{ $event->address }}</h3>

    <p>{{ $event->eventDate() }}</p>
    <p>{{ $event->eventTime() }}</p>

    <h1>TOPIK</h1>

    @foreach ($topics as $topic)
        <ul>
            <li>
                <img src="{{ gravatar_url($topic->speaker_email) }}" alt="Speaker avatar">

                <p>{{ $topic->title }}</p>
                <p>{{ $topic->speaker_name }}</p>

                <p>{{ $topic->desc }}</p>
            </li>
        </ul>
    @endforeach

    {{-- Jika user telah mendaftar dan kegiatan belum berlangsung maka kalimatnya: "X orang telah mendaftar"
    Jika user telah hadir dan kegiatan sedang/sudah berlangsung maka kalimatnya: "X orang telah hadir" --}}
    @if ($event->isOngoing() || $event->hasFinished())
        @if (empty($attended_count))
            <p>Belum ada yang hadir. Cepat datang!</p>
        @else
            <p>{{ $attended_count }}</p>
            <p>Orang telah hadir</p>
        @endif
    @else
        <p>{{ $reservation_count }}</p>
        <p>Orang telah mendaftar</p>

        <p>Silahkan daftar di sini!</p>
        {{-- Tampilkan form ini jika kegiatan belum berlangsung --}}
        <form action="/register" method="post">
            @csrf
            <input type="hidden" name="event_id" value="{{ $event->id }}">
            <input type="text" name="name_of_registrant" value="{{ old('name_of_registrant') }}" placeholder="Nama" required>
            <input type="email" name="registrant_email" value="{{ old('registrant_email') }}" placeholder="Email" required>
            <button type="submit">Daftar</button>
        </form>
    @endif
@endsection

@section('script')

@endsection
