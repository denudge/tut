<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 30.06.17
 * Time: 22:43
 */

namespace App\TimeTracking\Duration;

/**
 * Class DurationFormatter
 * @package App\TimeTracking\Duration
 */
class DurationFormatter
{
    /**
     * Time is defined as [HH]:MM in well-known spreadsheet applications
     * @param int $minutes
     * @return string
     */
    public static function minutesToTime(int $minutes)
    {
        return sprintf(
            '%s:%02d',
            str_pad((int) floor($minutes / Duration::HOUR) . '', 2, '0', STR_PAD_LEFT),
            $minutes % Duration::HOUR
        );
    }

    /**
     * @param int $value
     * @param int $steps
     * @return int
     */
    public static function quantize(int $value, int $steps = 0)
    {
        if ($steps <= 0) {
            return $value;
        }

        $factor = (int) ceil($value / $steps);
        return (int) ($factor * $steps);
    }
}
