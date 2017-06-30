<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 30.06.17
 * Time: 21:38
 */

namespace Tests\Unit\App\TimeTracking\Duration;

use App\TimeTracking\Duration\DuractionFactory;
use App\TimeTracking\Duration\Duration;
use Tests\TestCase;

class DurationTest extends TestCase
{
    protected $expectations = [
        0 => '0m',
        1 => '1m',
        41 => '41m',
        60 => '1h',
        121 => '2h 1m',
        420 => '7h',
        480 => '1d',
        481 => '1d 1m',
        541 => '1d 1h 1m',
        960 => '2d',
        2400 => '1w',
        2401 => '1w 1m',
        2460 => '1w 1h',
        2461 => '1w 1h 1m',
        2880 => '1w 1d',
        2881 => '1w 1d 1m',
        2941 => '1w 1d 1h 1m',
    ];

    public function testConstructor()
    {
        $sizes = ['m' => 1, 'h' => 2, 'd' => 3, 'w' => 4];
        $duration = new Duration(...array_values($sizes));

        $this->assertEquals($sizes['m'], $duration->getMinutes());
        $this->assertEquals($sizes['h'], $duration->getHours());
        $this->assertEquals($sizes['d'], $duration->getDays());
        $this->assertEquals($sizes['w'], $duration->getWeeks());
    }

    public function testNormalize()
    {
        $duration = new Duration(59);
        $duration->normalize();
        $this->assertEquals(59, $duration->getMinutes());
        $this->assertEquals(0, $duration->getHours());

        $duration = new Duration(60);
        $duration->normalize();
        $this->assertEquals(0, $duration->getMinutes());
        $this->assertEquals(1, $duration->getHours());

        $duration = new Duration(0, 7);
        $duration->normalize();
        $this->assertEquals(7, $duration->getHours());
        $this->assertEquals(0, $duration->getDays());

        $duration = new Duration(0, 8);
        $duration->normalize();
        $this->assertEquals(0, $duration->getHours());
        $this->assertEquals(1, $duration->getDays());

        $duration = new Duration(0, 0, 4);
        $duration->normalize();
        $this->assertEquals(4, $duration->getDays());
        $this->assertEquals(0, $duration->getWeeks());

        $duration = new Duration(0, 0, 5);
        $duration->normalize();
        $this->assertEquals(0, $duration->getDays());
        $this->assertEquals(1, $duration->getWeeks());

        $duration = new Duration(121);
        $duration->normalize();
        $this->assertEquals(1, $duration->getMinutes());
        $this->assertEquals(2, $duration->getHours());

        $duration = new Duration(480);
        $duration->normalize();
        $this->assertEquals(1, $duration->getDays());
        $this->assertEquals(0, $duration->getHours());
        $this->assertEquals(0, $duration->getMinutes());

        $duration = new Duration(481);
        $duration->normalize();
        $this->assertEquals(1, $duration->getDays());
        $this->assertEquals(0, $duration->getHours());
        $this->assertEquals(1, $duration->getMinutes());
    }

    public function testToString()
    {


        foreach ($this->expectations as $minutes => $expectedString) {
            $duration = new Duration($minutes);
            $duration->normalize();
            $this->assertEquals($expectedString, (string)$duration);
        }
    }

    public function testToInt()
    {
        foreach (array_keys($this->expectations) as $minutes) {
            $duration = new Duration($minutes);
            $duration->normalize();
            $this->assertEquals($minutes, $duration->toMinutes());
        }
    }

    public function testDurationFactory()
    {
        foreach ($this->expectations as $minutes => $string) {
            $duration = DuractionFactory::fromString($string);
            $duration->normalize();
            $this->assertEquals($minutes, $duration->toMinutes());
        }

        // special cases
        $duration = DuractionFactory::fromString('90m');
        $duration->normalize();
        $this->assertEquals(90, $duration->toMinutes());
        $this->assertEquals('1h 30m', (string) $duration);
    }
}
