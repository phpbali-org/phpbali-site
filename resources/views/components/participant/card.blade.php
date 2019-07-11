<div class="rounded-lg overflow-hidden bg-white shadow p-8 m-4 w-3/4 participant__identity">
    <form class="flex justify-end md:ml-auto" action="/" method="post">
        @csrf
        <input type="checkbox" name="participant_id" class="w-6 h-6 form-checkbox text-green-500"
        aria-label="{{ $participant->user()->first()->name }}" value="{{ $participant->user()->first()->id }}"
        @if (!empty($participant->attended_at)){{ "checked" }}@endif>
    </form>
    <div class="flex flex-col md:flex-row items-center">
        <div class="md:flex-shrink-0">
            <img src="{{ gravatar_url($participant->user()->first()->email) }}" alt="Attendee's avatar" class="rounded-full md:w-16 max-w-xs" width="50">
        </div>
        <div class="flex flex-col md:ml-4 mt-4 md:mt-0 items-center md:items-start">
            <p class="participant__name">
                {{ $participant->user()->first()->name }}
            </p>
            <p class="text-gray-600 text-sm">
                {{ $participant->user()->first()->email }}
            </p>
        </div>
    </div>
</div>
