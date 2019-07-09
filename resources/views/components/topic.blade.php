<div class="rounded-lg overflow-hidden border border-gray-400 p-8 m-4 md:w-3/4">
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
