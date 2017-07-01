<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 01.07.17
 * Time: 23:23
 */

namespace App\TimeTracking\Entry\Event;

use App\TimeTracking\Entry\Entry;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;

/**
 * Class EntryAddedEvent
 * @package App\TimeTracking\Entry\Event
 */
class EntryAddedEvent
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var Entry
     */
    public $entry;

    /**
     * OrderPurchasedEvent constructor.
     * @param Entry $entry
     */
    public function __construct(Entry $entry)
    {
        $this->entry = $entry;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return PrivateChannel
     */
    public function broadcastOn()
    {
        return new PrivateChannel('entry');
    }
}
