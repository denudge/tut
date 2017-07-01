<?php

namespace App\TimeTracking;

use App\TimeTracking\Entry\Commands\AddEntry;
use App\TimeTracking\Entry\Commands\AddEntryConsole;
use App\TimeTracking\Entry\Commands\DeleteEntryConsole;
use App\TimeTracking\Entry\Commands\ExportEntries;
use App\TimeTracking\Entry\Commands\ExportEntriesConsole;
use App\TimeTracking\Entry\Commands\ListDay;
use App\TimeTracking\Entry\Commands\ListDayConsole;
use App\TimeTracking\Entry\Commands\ListWeekConsole;
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

        $this->app->singleton(ExportEntries::class);
        $this->app->singleton(ExportEntriesConsole::class);
        $this->commands(ExportEntriesConsole::class);

        $this->app->singleton(ListDay::class);
        $this->app->singleton(ListDayConsole::class);
        $this->commands(ListDayConsole::class);

        $this->app->singleton(ListWeekConsole::class);
        $this->commands(ListWeekConsole::class);

        $this->app->singleton(DeleteEntryConsole::class);
        $this->commands(DeleteEntryConsole::class);
    }
}
