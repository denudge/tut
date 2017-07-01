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

    public function testQuantize()
    {
        $expectations = [
            60 => [51, 15],
            15 => [1, 15],
            10 => [10, 10],
            30 => [16, 15],
            17 => [17, 0],
            16 => [16, 1],
            18 => [17, 2],
            21 => [19, 3],
            20 => [17, 4],
        ];

        foreach ($expectations as $expectedResult => $arguments) {
            $this->assertEquals($expectedResult, DurationFormatter::quantize(...$arguments));
        }
    }
}