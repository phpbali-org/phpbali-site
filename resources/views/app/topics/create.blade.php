@extends('layouts.app')

@section('plugins.css')
    <link rel="stylesheet" href="{{ asset('css/choices.min.css') }}">
@endsection

@section('plugins.js')
    <script src="{{ asset('js/choices.min.js') }}" async></script>
@endsection

@section('content')
    <div class="w-full max-w-full m-auto">
      <form class="rounded px-8 pt-6 pb-8 mb-4" method="post" action="{{ $event->path() . "/topics/store" }}">
        @csrf
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="topicName">
            Nama Topik
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('title') border-red-500 @enderror" id="topicName"
              type="text" placeholder="Nama topik" name="title" value="{{ old('title') }}">
            @error('title')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="topicDesc">
            Deskripsi Topik
          </label>
          <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('desc') border-red-500 @enderror"
              id="topicDesc" name="desc">{{ old('desc') }}</textarea>
              @error('desc')
                  <p class="text-red-500 text-xs italic">{{ $message }}</p>
              @enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="topicSpeaker">
                Pembicara
            </label>
            <div class="inline-block relative w-full">
              <select class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline @error('speakers') border-red-500 @enderror" multiple id="topicSpeaker" name="speakers[]" value="{{ old('speakers') }}">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
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
@endsection

@section('script')
<script>
// Detect if a document has loaded with JavaScript
document.onreadystatechange = function () {
    if (document.readyState === 'complete') {
        new Choices('#topicSpeaker', {
            removeItemButton: true,
        });
    }
}
</script>
@endsection
