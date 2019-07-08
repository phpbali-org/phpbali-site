<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Models\User;

class ReminderOneDayBeforeEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:one-day-before-event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder one day before event to user';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $event = Event::with('reservations')
        ->where('published', 1)
        ->orderBy('created_at', 'desc')
        ->first();

        $date = \Carbon\Carbon::parse($event->start_datetime, 'Asia/Makassar')->subHours(24)->toDateString();
        $current_date = \Carbon\Carbon::now()->toDateString();

        if ($date === $current_date) {
            // Collect participant
            $participants = $event->reservations()->get()->map(function ($participant) {
                $event = Event::where('id', $participant['event_id'])->first();
                $user = User::where('id', $participant['user_id'])->first();
                return $user->notify(new \App\Notifications\ReminderOneDayBeforeEvent($event, $user));
            });
        }
    }
}
