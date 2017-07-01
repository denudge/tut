<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 01.07.17
 * Time: 10:46
 */

namespace App\TimeTracking\Entry\Commands;

use App\TimeTracking\Entry\Entry;
use App\TimeTracking\Entry\EntryFormatter;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

/**
 * Class ExportEntries
 * @package App\TimeTracking\Entry\Commands
 */
class ExportEntries
{
    /**
     * @var AddSum
     */
    protected $addSum;

    /**
     * ExportEntries constructor.
     * @param AddSum $addSum
     */
    public function __construct(AddSum $addSum)
    {
        $this->addSum = $addSum;
    }

    /**
     * @param int $period
     * @return Collection
     */
    public function __invoke(int $period): Collection
    {
        // Collect entries
        /** @var Collection $entries */
        $entries = Entry::where('period','=', $period)
            ->orderBy('date', 'ASC')
            ->orderBy('start', 'ASC')
            ->get();

        if (! $entries->count()) {
            throw new ModelNotFoundException('No entries found for period ' . $period . '.');
        }

        $entries = ($this->addSum)($entries);

        return $entries->map([EntryFormatter::class, 'toExport']);
    }
}
