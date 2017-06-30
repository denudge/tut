<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 30.06.17
 * Time: 07:51
 */

namespace App\TimeTracking\Entry\Commands;

use App\TimeTracking\Duration\DuractionFactory;
use App\TimeTracking\Entry\Entry;

/**
 * Class AddEntry
 * @package App\TimeTracking\Entry\Commands
 */
class AddEntry
{
    /**
     * @param string $duration
     * @param string $description
     * @param string $ticket
     * @param \DateTime|null $date
     * @return Entry
     */
    public function __invoke(string $duration, string $description, string $ticket = '', \DateTime $date = null)
    {
        if ($date == null) {
            $date = new \DateTime();
        }

        $day = $date->format('Y-m-d');
        $period = $date->format('Ym');

        $duration = trim($duration);
        if (empty($duration)) {
            throw new \InvalidArgumentException('Duration cannot be empty!');
        }

        $description = trim($description);
        if (empty($duration)) {
            throw new \InvalidArgumentException('Description cannot be empty!');
        }

        $dur = DuractionFactory::fromString($duration);
        $minutes = $dur->toMinutes();

        $start = new \DateTime();
        $end = new \DateTime();
        $start->sub(new \DateInterval('PT' . $minutes . 'M'));

        $entry = Entry::create([
            'user_id' => 0,
            'period' => $period,
            'project_id' => 0,
            'activity_id' => 0,
            'date' => $day,
            'start' => $start,
            'end' => $end,
            'duration' => $minutes,
            'ticket' => (string) $ticket,
            'description' => (string) $description,
        ]);

        return $entry;
    }
}