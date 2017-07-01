<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 01.07.17
 * Time: 22:55
 */

namespace App\TimeTracking\Jira\Factories;

use App\TimeTracking\Duration\DuractionFactory;
use App\TimeTracking\Entry\Entry;
use App\TimeTracking\Jira\Worklog;

/**
 * Class WorklogFactory
 * @package App\TimeTracking\Jira\Factories
 */
class WorklogFactory
{
    /**
     * @param Entry $entry
     * @return Worklog
     */
    public static function fromEntry(Entry $entry)
    {
        $duration = DuractionFactory::fromMinutes($entry->duration);

        return new Worklog([
            'comment' => (string) $entry->description,
            'started' => (string) static::getExtended8601DateTime(new \DateTime($entry->start)),
            'timeSpentSeconds' => '' . (int) $entry->duration * 60,
        ]);
    }

    /**
     * @return string
     */
    public static function getExtended8601DateTime(\DateTime $date)
    {
        return $date->format('Y-m-d\TH:i:s.')
        . '000'
        . $date->format("O");
    }
}
