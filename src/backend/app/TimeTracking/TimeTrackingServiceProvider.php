<?php

namespace App\TimeTracking;

use App\TimeTracking\Entry\Commands\AddEntry;
use App\TimeTracking\Entry\Commands\AddEntryConsole;
use Illuminate\Support\ServiceProvider;

/**
 * Class TimeTrackingServiceProvider
 * @package App\TimeTracking
 */
class TimeTrackingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AddEntry::class);
        $this->app->singleton(AddEntryConsole::class);
        $this->commands(AddEntryConsole::class);
    }
}
