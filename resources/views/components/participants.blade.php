<div class="flex flex-col items-center">
    @foreach ($event->reservations()->get() as $reservation)
        <div class="rounded-lg overflow-hidden border border-gray-400 p-8 m-4 w-screen max-w-sm md:max-w-5xl md:w-9/12">
            <div class="flex items-center">
                <div class="md:flex-shrink-0">
                    <img src="{{ gravatar_url($reservation->user()->first()->email) }}" alt="Attendee's avatar" class="rounded-full md:w-16 max-w-xs" width="50">
                </div>
                <div class="flex flex-col ml-6">
                    <p>
                        {{ $reservation->user()->first()->name }}
                    </p>
                    <p>
                        {{ $reservation->user()->first()->email }}
                    </p>
                </div>
                <form class="ml-auto" action="/" method="post">
                    @csrf
                    <input type="checkbox" name="has_attended">
                </form>
            </div>
        </div>
    @endforeach
</div>
