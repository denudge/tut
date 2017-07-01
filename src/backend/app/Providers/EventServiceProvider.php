<?php

namespace App\Providers;

use App\TimeTracking\Entry\Event\EntryAddedEvent;
use App\TimeTracking\Jira\Commands\AddWorklog;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => ['App\Listeners\EventListener'],
        EntryAddedEvent::class => [AddWorklog::class],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
