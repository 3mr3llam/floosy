<?php

namespace App\Support;

use Carbon\CarbonImmutable;

class CycleWindow
{
    public function __construct(
        public readonly CarbonImmutable $start,
        public readonly CarbonImmutable $end,
    ) {}

    public static function forTime(CarbonImmutable $time): self
    {
        $minute = (int) floor($time->minute / 10) * 10;
        $start = $time->setTime($time->hour, $minute, 0)->startOfMinute();
        $end = $start->addMinutes(10);
        return new self($start, $end);
    }
}
