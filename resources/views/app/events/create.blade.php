@extends('layouts.app')

@section('plugins.css')
    <link rel="stylesheet" href="{{ asset('css/flatpickr.min.css') }}">
@endsection

@section('plugins.js')
    <script src="{{ asset('js/flatpickr.min.js') }}" async></script>
@endsection

@section('content')
    <div class="w-full max-w-full m-auto">
      <form class="rounded px-8 pt-6 pb-8 mb-4" method="post" action="/events/store">
        @csrf
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="eventName">
            Nama Kegiatan
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" id="eventName" type="text" placeholder="Nama kegiatan" name="name">
            @error('name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="eventDesc">
            Deskripsi Kegiatan
          </label>
          <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('desc') border-red-500 @enderror" id="eventDesc" name="desc"></textarea>
              @error('desc')
                  <p class="text-red-500 text-xs italic">{{ $message }}</p>
              @enderror
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="eventPlace">
            Tempat
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('place_name') border-red-500 @enderror" id="eventPlace" type="text" placeholder="Tempat" name="place_name">
              @error('place_name')
                  <p class="text-red-500 text-xs italic">{{ $message }}</p>
              @enderror
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="eventAddress">
            Alamat
          </label>
          <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('address') border-red-500 @enderror" id="eventAddress" name="address"></textarea>
              @error('address')
                  <p class="text-red-500 text-xs italic">{{ $message }}</p>
              @enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="eventStartDateTime">
                Tanggal/Waktu Mulai
            </label>
            <input type="text" name="start_datetime" id="eventStartDateTime" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('start_datetime') border-red-500 @enderror">
                @error('start_datetime')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="eventEndDateTime">
                Tanggal/Waktu Selesai
            </label>
            <input type="text" name="end_datetime" id="eventEndDateTime" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('end_datetime') border-red-500 @enderror">
                @error('end_datetime')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
        </div>
        <div class="flex flex-col items-center justify-between">
          <button type="submit" class="bg-blue-500 w-full hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
            Simpan
          </button>
          <a class="bg-white border w-full py-2 px-4 rounded text-center my-4 font-bold text-sm text-blue-500 hover:text-blue-800" href="/events">
            Batal
          </a>
        </div>
      </form>
    </div>
@endsection

@section('script')
<script>
    flatpickr("#eventStartDateTime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true
    });

    flatpickr("#eventEndDateTime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true
    });
</script>
@endsection
