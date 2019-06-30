<div class="rounded-lg overflow-hidden bg-white shadow p-8 m-4 w-3/4">
    <form class="flex justify-end md:ml-auto" action="/" method="post">
        @csrf
        <input type="checkbox" name="has_attended">
    </form>
    <div class="flex flex-col md:flex-row items-center">
        <div class="md:flex-shrink-0">
            <img src="{{ gravatar_url($participant->user()->first()->email) }}" alt="Attendee's avatar" class="rounded-full md:w-16 max-w-xs" width="50">
        </div>
        <div class="flex flex-col md:ml-4 mt-4 md:mt-0 items-center md:items-start">
            <p>
                {{ $participant->user()->first()->name }}
            </p>
            <p class="text-gray-600 text-sm">
                {{ $participant->user()->first()->email }}
            </p>
        </div>
    </div>
</div>
