<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 30.06.17
 * Time: 22:24
 */

namespace App\TimeTracking\Entry\Commands;

use App\TimeTracking\Entry\Entry;
use Illuminate\Console\Command;

/**
 * Class DeleteEntryConsole
 * @package App\TimeTracking\Entry\Commands
 */
class DeleteEntryConsole extends Command
{
    /**
     * @var string
     */
    protected $signature = 'entry:delete {entryId}';

    /**
     * @var string
     */
    protected $description = 'Deletes a timetracking entry with the given ID.';

    /**
     * @return int
     */
    public function handle()
    {
        try {
            Entry::findOrFail((int) $this->argument('entryId'))->delete();
            $this->info('Timetracking entry with ID ' . $this->argument('entryId') . ' has been deleted.');
            return 0;
        } catch (\Exception $e) {
            $this->error('Error deleting timetracking entry: ' . $e->getMessage());
            return -1;
        }
    }
}
