<div class="w-full md:w-1/2 mt-16 m-auto">
    <form class="rounded px-8 pt-6 pb-8 mb-4" method="post" action="{{ $action }}">
        @isset($_method) @method($_method) @endisset
        @csrf
        <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="topicName">
            Nama Topik
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror" id="topicName"
            type="text" placeholder="Nama topik" name="title" value="{{ $topic->title }}">
            @error('title')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="topicDesc">
            Deskripsi Topik
        </label>
        <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('desc') border-red-500 @enderror"
            id="topicDesc" name="desc">{{ $topic->desc }}</textarea>
            @error('desc')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="topicSpeaker">
                Pembicara
            </label>
            <div class="inline-block relative w-full">
            <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline @error('speakers') border-red-500 @enderror" multiple id="topicSpeaker" name="speakers[]">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}"
                        @if ($speakers->isNotEmpty())
                            @if ($speakers->contains($user->id))
                                {{ "selected" }}
                            @endif
                        @endif>{{ $user->name }} - {{ $user->email }}</option>
                @endforeach
            </select>
            </div>
            @error('speakers')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex flex-col items-center justify-between">
        <button type="submit" class="bg-blue-500 w-full hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
            Simpan
        </button>
        <a class="bg-white border w-full py-2 px-4 rounded text-center my-4 font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ $event->path() }}">
            Batal
        </a>
        </div>
    </form>
</div>
