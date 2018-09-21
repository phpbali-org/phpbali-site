<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(Schema::hasTable('events'))
        {
            $event = Event::where('published',1)
                ->orderBy('created_at','desc')
                ->with('topic')
                ->with('rsvp')
                ->first();
            View::share('event', $event);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
