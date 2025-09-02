<?php

namespace App\Services;

use App\Support\CycleWindow;
use Carbon\CarbonImmutable;

/**
 * Service to compute the current 10-minute CycleWindow.
 */
class CycleBucketing
{
    /**
     * Return the CycleWindow for now or a supplied time.
     */
    public function currentWindow(?CarbonImmutable $now = null): CycleWindow
    {
        $now = $now ?? CarbonImmutable::now();
        return CycleWindow::forTime($now);
    }
}
