<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 30.06.17
 * Time: 22:24
 */

namespace App\TimeTracking\Entry\Commands;

use Illuminate\Console\Command;

/**
 * Class AddEntryConsole
 * @package App\TimeTracking\Entry\Commands
 */
class AddEntryConsole extends Command
{
    /**
     * @var string
     */
    protected $signature = 'entry:add {duration} {ticket} {description}';

    /**
     * @var string
     */
    protected $description = 'Adds a new timetracking entry';

    /**
     * @param AddEntry $addEntry
     * @return int
     */
    public function handle(AddEntry $addEntry)
    {
        try {
            $entry = $addEntry($this->argument('duration'), $this->argument('description'), $this->argument('ticket'));
            $this->info('Timetracking entry has been added with ID ' . $entry->id);
            return 0;
        } catch (\Exception $e) {
            $this->error('Error adding timetracking entry: ' . $e->getMessage());
            return -1;
        }
    }
}
