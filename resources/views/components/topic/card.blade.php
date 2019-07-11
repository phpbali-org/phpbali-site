<div class="rounded-lg overflow-hidden border border-gray-400 p-8 m-4 md:w-3/4">
    <div class="flex flex-col">
        <div class="mt-4 md:mt-0 md:ml-6">
            <p class="uppercase tracking-wide text-sm text-indigo-600 font-bold">{{ $topic->title }}</p>
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
            @if (auth()->check() && auth()->user()->isAdmin())
                <div class="flex justify-end ml-auto">
                    <button type="button" data-href="{{ $event->path()."/topics/{$topic->slug}" }}" data-title="{{ $topic->title }}" class="delete__topic mr-4 bg-red-600 hover:bg-red-500 text-white font-semibold py-2 px-4 border border-red-600 rounded shadow">Hapus</button>
                    <a href="{{ route('topic.edit', ['event' => $event, 'topic' => $topic]) }}" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Edit</a>
                </div>
            @endif
        </div>
    </div>
</div>
