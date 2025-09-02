<?php

namespace App\Support;

use Carbon\CarbonImmutable;

/**
 * Immutable value object representing a 10-minute batching window
 * with normalized start and end timestamps.
 */
class CycleWindow
{
    public function __construct(
        public readonly CarbonImmutable $start,
        public readonly CarbonImmutable $end,
    ) {}

    /**
     * Compute the 10-minute window that contains the given time.
     */
    public static function forTime(CarbonImmutable $time): self
    {
        $minute = (int) floor($time->minute / 10) * 10;
        $start = $time->setTime($time->hour, $minute, 0)->startOfMinute();
        $end = $start->addMinutes(10);
        return new self($start, $end);
    }
}
