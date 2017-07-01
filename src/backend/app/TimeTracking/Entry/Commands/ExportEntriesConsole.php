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

    public function handle(ExportEntries $exportEntries)
    {
        $data = $exportEntries($this->argument('period'));

        if (!count($data)) {
            $this->info('We could not find any entry.');
            return 0;
        }

        // write data to csv
        $outfilepath = 'export_' . $this->argument('period') . '.csv';
        $outfile = fopen($outfilepath, 'w+');
        fputcsv($outfile, array_keys($data[0]));
        foreach($data as $line) {
            fputcsv($outfile, array_values($line));
        }
        fclose($outfile);

        $this->info('Data has been exported to ' . $outfilepath);
        return 0;
    }
}
