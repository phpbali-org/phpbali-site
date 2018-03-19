<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $event = Events::where('published',1)
                ->orderBy('created_at','desc')
                ->with('topic')
                ->with('rsvp')
                ->first();
         View::share('event', $event);
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
