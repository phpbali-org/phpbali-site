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
        if (!app()->isLocal()) {
            \URL::forceScheme('https');

            $view = config('view.compiled');
            $storage = config('vercel.storage');
            $logs = config('vercel.logs_path');
            foreach ([$view, $storage, $logs] as $path) {
                if (! is_dir($path)) {
                    mkdir($path, 0775, true);
                }
            }
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Set custom storage path in production mode
        if (!app()->isLocal()) {
            $this->app->instance('path.storage', '/tmp/storage');
        }        
    }
}
