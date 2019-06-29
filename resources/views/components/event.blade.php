<div class="rounded-lg overflow-hidden border border-gray-400 p-6 m-4">
    <div class="md:flex">
        <div class="mt-4 md:mt-0 md:ml-6">
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
                    <p>{{ $event->totalReservation() }} orang telah mendaftar</p>
                    <p class="md:ml-4">{{ $event->totalAttendance() }} orang telah hadir</p>
                </div>
            @endif
        </div>
    </div>
    @if (auth()->check() && (auth()->user()->isStaff() || auth()->user()->isAdmin()))
        <div class="flex justify-end mt-4">
            @if ($event->published)
                <form action="{{ $event->path() . "/unpublish" }}" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf
                    <button type="submit" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Batal publikasi</button>
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
