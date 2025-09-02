<?php

namespace App\Services;

use App\Contracts\FeePolicy;
use App\Models\SiteSetting;
use App\Support\Money;

class DefaultFeePolicy implements FeePolicy
{
    public function calculateFee(Money $gross): Money
    {
        $settings = SiteSetting::first();
        $percentage = $settings?->fee_percentage ?? 2.0; // default 2%
        $feeMinor = (int) round($gross->amountMinor * ($percentage / 100));
        return new Money($gross->currency, $feeMinor);
    }
}
