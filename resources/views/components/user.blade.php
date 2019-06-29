<div class="flex items-center bg-white rounded-lg p-6 m-4 shadow overflow-hidden">
    <img class="h-16 w-16 md:h-24 md:w-24 rounded-full mr-auto" src="{{ $user->avatar() }}">
    <div class="flex flex-col text-left my-auto mr-auto">
        <h2 class="text-lg">{{ $user->name }}</h2>
        <p class="text-gray-600">{{ $user->email }}</p>
    </div>
</div>
