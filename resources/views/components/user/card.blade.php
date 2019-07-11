<div class="rounded-lg overflow-hidden bg-white shadow p-8 m-4 w-3/4 user__identity">
    <div class="flex flex-col md:flex-row items-center">
        <div class="md:flex-shrink-0">
            <img src="{{ $user->avatar() }}" alt="Attendee's avatar" class="rounded-full md:w-16 max-w-xs" width="50">
        </div>
        <div class="flex flex-col md:ml-4 mt-4 md:mt-0 items-center md:items-start">
            <p class="user__name">
                {{ $user->name }}
            </p>
            <p class="text-gray-600 text-sm">
                {{ $user->email }}
            </p>
        </div>
        @if (auth()->check() && auth()->user()->isAdmin())
            <div class="flex justify-end ml-auto mt-6">
                <button type="button" data-href="{{ $user->path() }}" data-name="{{ $user->name }}" class="delete__user mr-4 bg-red-600 hover:bg-red-500 text-white font-semibold py-2 px-4 border border-red-600 rounded shadow">Hapus</button>
                <a href="{{ route('user.edit', ['user' => $user]) }}" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">Edit</a>
            </div>
        @endif
    </div>
</div>
