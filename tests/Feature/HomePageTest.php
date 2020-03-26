<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomePageTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Test guest can see event name.
     *
     * @return void
     */
    public function testGuestCanSeeHomePage()
    {
        $event = factory('App\Models\Event')->create();
        // Set event is published and save it
        $event->published = '1';
        $event->save();

        $this->get('/')
            ->assertSee($event->name)
            ->assertSee($event->place_name)
            ->assertSee($event->address)
            ->assertSee($event->eventDate())
            ->assertSee($event->eventTime())
            ->assertStatus(200);
    }
}
