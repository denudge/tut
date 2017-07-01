<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 01.07.17
 * Time: 10:56
 */

namespace App\TimeTracking\Entry\Commands;

use App\TimeTracking\Entry\Entry;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class AddSum
 * @package App\TimeTracking\Entry\Commands
 */
class AddSum
{
    /**
     * @param Collection $entries
     * @return Collection
     */
    public function __invoke(Collection $entries)
    {
        $sum = 0;
        foreach ($entries as $entry) {
            // Did we already do this?
            if ($entry->data === 'Summe') {
                return $entries;
            }
            $sum += $entry->duration;
        }
        $entries->add(new Entry([ 'description' => 'Summe', 'duration' => $sum ]));

        return $entries;
    }
}
