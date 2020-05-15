<div class="bg-white shadow rounded-lg overflow-hidden border p-4 m-4">
    <div class="m-4">
        <p class="uppercase tracking-wide text-sm text-indigo-600 font-bold">{{ $topic->title }}</p>
        <p class="mt-2 text-black">{{ $topic->desc }}</p>
        <ul class="flex flex-wrap items-center mt-4">
            @foreach ($topic->speakers()->get() as $speaker)
                <li class="flex items-center md:w-1/2">
                    <img data-src="{{ $speaker->avatar() }}" alt="Speaker's avatar" class="rounded-full md:w-16 max-w-xs my-4" width="50">
                    <div class="mt-0 mx-4">
                        <p class="">{{ $speaker->name }}</p>
                    </div>
                </li>
            @endforeach
        </ul>
        @if (auth()->check() && auth()->user()->isAdmin())
            <div class="flex justify-end">
                <button type="button" class="btn delete__btn" 
                    data-href="{{ $event->path()."/topics/{$topic->slug}" }}" 
                    data-dialog-title="Menghapus Topik?"
                    data-dialog-body="Anda akan menghapus topik {{ $topic->title }} dan tidak dapat dikembalikan lagi. Anda yakin?">Hapus</button>
                <a href="{{ route('topic.edit', ['event' => $event, 'topic' => $topic]) }}" class="btn default__btn">Edit</a>
            </div>
        @endif
    </div>
</div>
