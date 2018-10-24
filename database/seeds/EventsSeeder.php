<?php

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Event::class, 30)->create();
    }
}
