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
 * Class ExportEntriesConsole
 * @package App\TimeTracking\Entry\Commands
 */
class ExportEntriesConsole extends Command
{
    protected $signature = 'entry:export {period}';

    protected $description = 'Export entries of a given period as CSV data';

    public function handle()
    {
        // Collect entries
        $entries = Entry::where('period','=', $this->argument('period'))
            ->orderBy('date', 'ASC')
            ->orderBy('start', 'ASC')
            ->get();

        if (! $entries->count()) {
            $this->info('We could not find any entry.');
            return 0;
        }

        // Format entries
        $out = [];
        $sum = 0;
        foreach ($entries as $entry) {
            $sum += $entry->duration;
            $out[] = [
                'Datum' => (new \DateTime($entry->date))->format('d.m.Y'),
                'Ticket' => $entry->ticket,
                'Dauer' => DurationFormatter::minutesToTime($entry->duration),
                'Beschreibung' => $entry->description,
            ];
        }

        // write data to csv
        $outfilepath = 'export_' . $this->argument('period') . '.csv';
        $outfile = fopen($outfilepath, 'w+');
        fputcsv($outfile, array_keys($out[0]));
        foreach($out as $line) {
            fputcsv($outfile, array_values($line));
        }
        fputcsv($outfile, [ 'Summe', '', DurationFormatter::minutesToTime($sum) ]);
        fclose($outfile);

        $this->info('Data has been exported to ' . $outfilepath);
        return 0;
    }
}
