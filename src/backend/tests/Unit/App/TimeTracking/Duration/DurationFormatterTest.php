<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 30.06.17
 * Time: 22:48
 */

namespace Tests\Unit\App\TimeTracking\Duration;

use App\TimeTracking\Duration\DurationFormatter;
use Tests\TestCase;

class DurationFormatterTest extends TestCase
{
    public function testMinutesToTime()
    {
        $expectations = [
            0 => '00:00',
            1 => '00:01',
            59 => '00:59',
            60 => '01:00',
            61 => '01:01',
            247 => '04:07',
            480 => '08:00',
            481 => '08:01',
            2400 => '40:00',
            2401 => '40:01',
            10000 => '166:40',
        ];

        foreach ($expectations as $minutes => $time) {
            $this->assertEquals($time, DurationFormatter::minutesToTime($minutes));
        }
    }
}