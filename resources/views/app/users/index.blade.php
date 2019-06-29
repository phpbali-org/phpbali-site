@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold text-center">Pengguna</h1>
    <hr class="my-8 border-b-2 border-gray-200 w-3/4 md:w-1/2">
    <div class="m-auto">
        @foreach ($users as $user)
            @include('components.user', ['user' => $user])
        @endforeach
    </div>

    <div class="flex flex-col align-end fixed z-1000" style="bottom: 24px; right: 24px;">
        <a href="users/create" class="relative rounded-full shadow border bg-white hover:bg-gray-100 text-gray-800 border-gray-400 py-4 px-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="fill-current w-8 h-8">
                <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"/>
            </svg>
        </a>
    </div>
@endsection
