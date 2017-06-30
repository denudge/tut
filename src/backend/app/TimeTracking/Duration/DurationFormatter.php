<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 30.06.17
 * Time: 22:43
 */

namespace App\TimeTracking\Duration;


class DurationFormatter
{
    /**
     * Time is defined as [HH]:MM in well-known spreadsheet applications
     */
    public static function minutesToTime(int $minutes)
    {
        return sprintf(
            '%s:%02d',
            str_pad((int) floor($minutes / Duration::HOUR) . '', 2, '0', STR_PAD_LEFT),
            $minutes % Duration::HOUR
        );
    }
}
