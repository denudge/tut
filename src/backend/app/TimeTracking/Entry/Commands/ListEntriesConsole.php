<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 30.06.17
 * Time: 23:00
 */

namespace App\TimeTracking\Entry\Commands;

use App\TimeTracking\Duration\DurationFormatter;
use App\TimeTracking\Entry\Entry;
use Illuminate\Console\Command;

/**
 * Class ListEntriesConsole
 * @package App\TimeTracking\Entry\Commands
 */
class ListEntriesConsole extends Command
{
    /**
     * @var string
     */
    protected $signature = 'entry:today';

    /**
     * @var string
     */
    protected $description = 'List today\'s entries';

    /**
     * @param ListEntries $listEntries
     * @return int
     */
    public function handle(ListEntries $listEntries)
    {
        try {
            $data = $listEntries();

            $this->table(array_keys($data[0]), $data);
            return 0;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return -1;
        }
    }
}
