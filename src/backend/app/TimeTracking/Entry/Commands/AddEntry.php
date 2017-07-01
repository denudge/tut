<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 30.06.17
 * Time: 07:51
 */

namespace App\TimeTracking\Entry\Commands;

use App\TimeTracking\Duration\DuractionFactory;
use App\TimeTracking\Duration\Duration;
use App\TimeTracking\Duration\DurationFormatter;
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

        $end = new \DateTime();

        // auto duration detection
        $regexp = '/^auto([\/](\d+))?$/';
        if (preg_match($regexp, $duration, $matches)) {
            $result = $this->detectDuration($matches[2] ?? 0);
            $minutes = $result['minutes'];
            $start = $result['start'];
            $end = new \DateTime($start->format('c'));
            $end->add(new \DateInterval('PT' . $minutes . 'M'));
        } else {
            $dur = DuractionFactory::fromString($duration);
            $minutes = $dur->toMinutes();
            $start = new \DateTime();
            $start->sub(new \DateInterval('PT' . $minutes . 'M'));
        }

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

    /**
     * @param int $quantize
     * @return array
     * @throws \LogicException
     */
    private function detectDuration(int $quantize = 0): array
    {
        $end = new \DateTime();
        $day = $end->format('Y-m-d');

        $lastEntry = Entry::where('date','=',$day)
            ->where('end', '<=', $end)
            ->orderBy('end', 'DESC')
            ->first();

        if ($lastEntry === null) {
            throw new \LogicException('Cannot autodetect duration: No previous entry found.');
        }

        $start = new \DateTime($lastEntry->end);
        $interval = $end->diff($start);
        $minutes = abs(Duration::HOUR * (int) $interval->h + (int) $interval->i);

        // quantize
        $minutes = DurationFormatter::quantize($minutes, $quantize);

        return [
            'minutes' => $minutes,
            'start' => $start,
        ];
    }
}
