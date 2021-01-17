<?php

namespace App\Providers;

// use App\Models\Event;
// use Illuminate\Support\Facades\Schema;
// use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // if (Schema::hasTable('events')) {
        //     $event = Event::where('published', 1)
        //         ->orderBy('created_at', 'desc')
        //         ->with('topic')
        //         ->with('rsvp')
        //         ->first();
        //     View::share('event', $event);
        // }

        $view = config('view.compiled');
        $logs = config('vercel.logs_path');
        // $ssr = config('ssr.node.temp_path');
        foreach ([$view, $logs] as $path) {
            if (! is_dir($path)) {
                mkdir($path, 0755, true);
            }
        }

        if (!app()->isLocal()) {
            \URL::forceScheme('https');
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
