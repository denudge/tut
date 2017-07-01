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
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class ListWeekConsole
 * @package App\TimeTracking\Entry\Commands
 */
class ListWeekConsole extends Command
{
    /**
     * @var string
     */
    protected $signature = 'entry:week';

    /**
     * @var string
     */
    protected $description = 'List this week\'s entries';

    /**
     * @param ListDay $listDay
     * @return int
     */
    public function handle(ListDay $listDay)
    {
        try {
            $today = (new \DateTime())->setTime(0, 0);

            // set cursor to start of week
            $cursor = (new \DateTime())->setTime(0, 0);
            $cursor->sub(new \DateInterval('P' . (int) date('w') . 'D'));

            do {
                $cursor->add(new \DateInterval('P1D'));
                try {
                    $data = $listDay($cursor);
                    $this->table(array_keys($data[0]), $data);
                } catch (ModelNotFoundException $e) {
                    $this->info($cursor->format('d.m.Y') . ': No entries.');
                }
            } while ($cursor < $today);

            return 0;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return -1;
        }
    }
}
