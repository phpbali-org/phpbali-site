@extends('layouts.app')

@section('content')
    <div class="w-full max-w-full m-auto">
      <form class="rounded px-8 pt-6 pb-8 mb-4" method="post" action="{{ $event->path() . "/attendees/store" }}">
        @csrf
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="participantName">
            Nama
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" id="participantName" type="text" placeholder="Nama" name="name" autofocus>
            @error('name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="participantEmail">
            Email
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" id="participantEmail" type="text" placeholder="Email" name="email">
              @error('email')
                  <p class="text-red-500 text-xs italic">{{ $message }}</p>
              @enderror
        </div>
        <div class="flex flex-col items-center justify-between">
          <button type="submit" class="bg-blue-500 w-full hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
            Simpan
          </button>
          <a class="bg-white border w-full py-2 px-4 rounded text-center my-4 font-bold text-sm text-blue-500 hover:text-blue-800" href="{{ url()->previous() }}">
            Batal
          </a>
        </div>
      </form>
    </div>
@endsection
