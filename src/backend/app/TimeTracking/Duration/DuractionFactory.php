<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 30.06.17
 * Time: 21:19
 */

namespace App\TimeTracking\Duration;

/**
 * Class DuractionFactory
 * @package App\TimeTracking\Duration
 */
class DuractionFactory
{
    /**
     * @param string $in
     * @return Duration
     */
    public static function fromString(string $in): Duration
    {
        $rest = strtolower(trim($in));
        $regexp = '/^(\d+)([wdhm])([ ](.+))?$/';

        $sizes = ['m' => 0, 'h' => 0, 'd' => 0, 'w' => 0];

        do {
            if (preg_match($regexp, $rest, $matches) == 1) {
                $count = $matches[1];
                $size = $matches[2];
                $sizes[$size] += $count;
                if (array_key_exists(3, $matches)) {
                    $rest = trim($matches[3]);
                } else {
                    $rest = '';
                }
            } else {
                throw new \InvalidArgumentException('Cannot parse duration string "' . $in . '": Format error.');
            }
        } while ($rest !== '');

        $duration = new Duration(...array_values($sizes));
        $duration->normalize();

        return $duration;
    }

    /**
     * @param int $minutes
     * @return Duration
     */
    public static function fromMinutes(int $minutes)
    {
        $duration = new Duration($minutes);
        $duration->normalize();

        return $duration;
    }
}
