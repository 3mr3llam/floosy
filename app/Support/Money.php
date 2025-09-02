<?php

namespace App\Support;

use InvalidArgumentException;

class Money
{
    public function __construct(
        public readonly string $currency,
        public readonly int $amountMinor // store in minor units (e.g., halalas)
    ) {
        if ($this->amountMinor < 0) {
            throw new InvalidArgumentException('Money cannot be negative.');
        }
    }

    public static function sarFromFloat(float $amount): self
    {
        return new self('SAR', (int) round($amount * 100));
    }

    public function toFloat(): float
    {
        return $this->amountMinor / 100.0;
    }

    public function add(self $other): self
    {
        $this->assertSameCurrency($other);
        return new self($this->currency, $this->amountMinor + $other->amountMinor);
    }

    public function subtract(self $other): self
    {
        $this->assertSameCurrency($other);
        if ($other->amountMinor > $this->amountMinor) {
            throw new InvalidArgumentException('Resulting money would be negative.');
        }
        return new self($this->currency, $this->amountMinor - $other->amountMinor);
    }

    private function assertSameCurrency(self $other): void
    {
        if ($this->currency !== $other->currency) {
            throw new InvalidArgumentException('Currency mismatch.');
        }
    }
}
