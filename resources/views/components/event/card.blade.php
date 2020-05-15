<div class="bg-white shadow rounded-lg overflow-hidden border p-4 m-4">
    <div class="m-4">
        <div class="uppercase tracking-wide text-sm text-indigo-600 font-bold">
            <time>{{ $event->eventDate() }} {{ $event->eventTime() }}</time>
        </div>
        <p class="block mt-1 text-lg leading-tight font-semibold text-gray-900 underline">
            <a href="{{ $event->path() }}">{{ $event->name }}</a>
        </p>
        <address class="mt-2 text-gray-600">
            <strong>{{ $event->place_name }}</strong> . {{ $event->address }}
        </address>
        @if (auth()->check() && (auth()->user()->isStaff() || auth()->user()->isAdmin()))
            <div class="flex flex-col md:flex-row">
                <p>{{ $event->totalReservation() }} mendaftar</p>
                <p class="md:ml-4">{{ $event->totalAttendance() }} hadir</p>
            </div>
        @endif
    </div>
    @if (auth()->check() && (auth()->user()->isStaff() || auth()->user()->isAdmin()))
        <div class="flex justify-end">
            <button type="button" data-name="{{ $event->name }}" data-href="{{ $event->path() }}" class="delete__btn m-4 bg-red-600 hover:bg-red-500 text-white font-semibold py-2 px-4 border border-red-600 rounded shadow focus:outline-none focus:shadow-outline">Hapus</button>
            @if ($event->published)
                <form action="{{ $event->path() . "/unpublish" }}" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf
                    <button type="submit" class="m-4 bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow focus:outline-none focus:shadow-outline">Batal publikasi</button>
                </form>
            @else
                <form action="{{ $event->path() . "/publish" }}" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Publikasi</button>
                </form>
            @endif
        </div>
    @endif
</div>
