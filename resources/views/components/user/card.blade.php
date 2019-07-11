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
    </div>
</div>
