@extends('layouts.app')

@section('content')
    <div class="w-full max-w-full m-auto">
      <form class="rounded px-8 pt-6 pb-8 mb-4" method="post" action="/users/store">
        @csrf
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
            Nama
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" id="topicName"
              type="text" placeholder="Nama" name="name" value="{{ old('name') }}">
            @error('name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
            Email
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" id="email"
              type="email" placeholder="Email" name="email" value="{{ old('email') }}">
            @error('email')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="md:flex md:items-center mb-6">
            <label class="w-full block text-gray-500 font-bold">
              <input class="mr-2 leading-tight" type="checkbox" name="is_staff" value="1">
              <span class="text-base">
                Staff
              </span>
            </label>
        </div>
        @if (auth()->user()->isAdmin())
            <div class="md:flex md:items-center mb-6">
                <label class="w-full block text-gray-500 font-bold">
                  <input class="mr-2 leading-tight" type="checkbox" name="is_admin" value="1">
                  <span class="text-base">
                    Admin
                  </span>
                </label>
            </div>
        @endif
        <div class="flex flex-col items-center justify-between">
          <button type="submit" class="bg-blue-500 w-full hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
            Simpan
          </button>
          <a class="bg-white border w-full py-2 px-4 rounded text-center my-4 font-bold text-sm text-blue-500 hover:text-blue-800" href="/users">
            Batal
          </a>
        </div>
      </form>
    </div>
@endsection
