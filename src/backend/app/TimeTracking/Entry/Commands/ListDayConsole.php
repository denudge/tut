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
class ListDayConsole extends Command
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
     * @param ListDay $listDay
     * @return int
     */
    public function handle(ListDay $listDay)
    {
        try {
            $data = $listDay();

            $this->table(array_keys($data[0]), $data);
            return 0;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return -1;
        }
    }
}
