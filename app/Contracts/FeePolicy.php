<?php

namespace App\Contracts;

use App\Support\Money;

/**
 * Strategy contract for calculating the fee for a given gross amount.
 */
interface FeePolicy
{
    /**
     * Calculate the fee as a Money amount based on the gross amount.
     */
    public function calculateFee(Money $gross): Money;
}
