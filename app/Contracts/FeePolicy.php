<?php

namespace App\Contracts;

use App\Support\Money;

interface FeePolicy
{
    public function calculateFee(Money $gross): Money;
}
