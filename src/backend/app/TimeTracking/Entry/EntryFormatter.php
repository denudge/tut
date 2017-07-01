<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 01.07.17
 * Time: 10:49
 */

namespace App\TimeTracking\Entry;

use App\TimeTracking\Duration\DurationFormatter;

/**
 * Class EntryExportFormatter
 * @package App\TimeTracking\Entry
 */
class EntryFormatter
{
    /**
     * @param Entry $entry
     * @return array
     */
    public static function toExport(Entry $entry): array
    {
        return [
            'Datum' => (!empty($entry->date) ? (new \DateTime($entry->date))->format('d.m.Y') : ''),
            'Ticket' => $entry->ticket,
            'Dauer' => DurationFormatter::minutesToTime($entry->duration),
            'Beschreibung' => $entry->description,
        ];
    }

    /**
     * @param Entry $entry
     * @return array
     */
    public static function toConsole(Entry $entry): array
    {
        return [
            'ID' => $entry->id,
            'Datum' => (!empty($entry->date) ? (new \DateTime($entry->date))->format('d.m.Y') : ''),
            'Ticket' => $entry->ticket,
            'Dauer' => DurationFormatter::minutesToTime($entry->duration),
            'Beschreibung' => $entry->description,
            'Start' => (!empty($entry->start) ? (new \DateTime($entry->start))->format('H:i') : ''),
            'Ende' => (!empty($entry->end) ? (new \DateTime($entry->end))->format('H:i') : ''),
        ];
    }
}
