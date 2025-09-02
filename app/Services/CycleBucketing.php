<?php

namespace App\Services;

use App\Support\CycleWindow;
use Carbon\CarbonImmutable;

class CycleBucketing
{
    public function currentWindow(?CarbonImmutable $now = null): CycleWindow
    {
        $now = $now ?? CarbonImmutable::now();
        return CycleWindow::forTime($now);
    }
}
