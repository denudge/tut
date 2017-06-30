<?php
/**
 * Created by IntelliJ IDEA.
 * User: nudge
 * Date: 30.06.17
 * Time: 15:33
 */

namespace App\TimeTracking\Duration;


class Duration
{
    const WEEK = 5 * 8 * 60;

    const DAY = 8 * 60;

    const HOUR = 60;

    const MINUTE = 1;

    /**
     * @var int
     */
    protected $weeks = 0;

    /**
     * @var int
     */
    protected $days = 0;

    /**
     * @var int
     */
    protected $hours = 0;

    /**
     * @var int
     */
    protected $minutes = 0;

    /**
     * Duration constructor.
     * @param int $minutes
     * @param int $hours
     * @param int $days
     * @param int $weeks
     */
    public function __construct(int $minutes, int $hours = 0, int $days = 0, int $weeks = 0)
    {
        $this->minutes = $minutes;
        $this->hours = $hours;
        $this->days = $days;
        $this->weeks = $weeks;
    }

    /**
     * @return int
     */
    public function getWeeks(): int
    {
        return $this->weeks;
    }

    /**
     * @param int $weeks
     */
    public function setWeeks(int $weeks)
    {
        $this->weeks = $weeks;
    }

    /**
     * @return int
     */
    public function getDays(): int
    {
        return $this->days;
    }

    /**
     * @param int $days
     */
    public function setDays(int $days)
    {
        $this->days = $days;
    }

    /**
     * @return int
     */
    public function getHours(): int
    {
        return $this->hours;
    }

    /**
     * @param int $hours
     */
    public function setHours(int $hours)
    {
        $this->hours = $hours;
    }

    /**
     * @return int
     */
    public function getMinutes(): int
    {
        return $this->minutes;
    }

    /**
     * @param int $minutes
     */
    public function setMinutes(int $minutes)
    {
        $this->minutes = $minutes;
    }

    /**
     * @return int
     */
    public function toMinutes(): int
    {
        return ($this->weeks * static::WEEK)
            + ($this->days * static::DAY)
            + ($this->hours * static::HOUR)
            + ($this->minutes * static::MINUTE);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        $out = ($this->weeks ? $this->weeks . 'w ' : '')
            . ($this->days ? $this->days . 'd ' : '')
            . ($this->hours ? $this->hours . 'h ' : '')
            . ($this->minutes ? $this->minutes . 'm ' : '');

        $out = trim($out);
        if ($out === '') {
            return '0m';
        } else {
            return $out;
        }
    }

    /**
     * Normalizes the individual fields to its canonical form
     */
    public function normalize()
    {
        $this->hours += (int) floor($this->minutes / static::HOUR);
        $this->minutes %= static::HOUR;

        $this->days += (int) floor($this->hours / (static::DAY / static::HOUR));
        $this->hours %= (static::DAY / static::HOUR);

        $this->weeks += (int) floor($this->days / (static::WEEK / static::DAY));
        $this->days %= (static::WEEK / static::DAY);
    }
}
