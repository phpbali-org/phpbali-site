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
            <button type="button" class="btn delete__btn" 
                data-dialog-title="Menghapus Event?"
                data-dialog-body="Anda akan menghapus event {{ $event->name }} dan tidak dapat dikembalikan lagi. Anda yakin?"
                data-href="{{ $event->path() }}">Hapus</button>
            @if ($event->published)
                <form action="{{ $event->path() . "/unpublish" }}" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf
                    <button type="submit" class="btn default__btn">Batal publikasi</button>
                </form>
            @else
                <form action="{{ $event->path() . "/publish" }}" method="post">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf
                    <button type="submit" class="btn primary__btn">Publikasi</button>
                </form>
            @endif
        </div>
    @endif
</div>
