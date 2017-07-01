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
 * Class ListEntries
 * @package App\TimeTracking\Entry\Commands
 */
class ListEntries
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
     * @return Collection
     * @throws ModelNotFoundException
     */
    public function __invoke(): Collection
    {
        // Collect entries
        /** @var Collection $entries */
        $entries = Entry::where('date','=', (new \DateTime())->format('Y-m-d'))
            ->orderBy('date', 'ASC')
            ->orderBy('start', 'ASC')
            ->get();

        if (! $entries->count()) {
            throw new ModelNotFoundException('No entries found for today.');
        }

        $entries = ($this->addSum)($entries);

        return $entries->map([EntryFormatter::class, 'toConsole']);
    }
}
