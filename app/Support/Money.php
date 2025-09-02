<?php

namespace App\Support;

use InvalidArgumentException;

/**
 * Value object for currency amounts stored in minor units (e.g., halalas for SAR).
 * Provides safe arithmetic without floating point errors.
 */
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

    /**
     * Create a SAR money instance from a float value (e.g., 12.34 SAR).
     */
    public static function sarFromFloat(float $amount): self
    {
        return new self('SAR', (int) round($amount * 100));
    }

    /**
     * Convert minor units back to a float representation.
     */
    public function toFloat(): float
    {
        return $this->amountMinor / 100.0;
    }

    /**
     * Return a new Money that is the sum of this and the other amount.
     */
    public function add(self $other): self
    {
        $this->assertSameCurrency($other);
        return new self($this->currency, $this->amountMinor + $other->amountMinor);
    }

    /**
     * Return a new Money that is this amount minus the other amount.
     * Throws if result would be negative.
     */
    public function subtract(self $other): self
    {
        $this->assertSameCurrency($other);
        if ($other->amountMinor > $this->amountMinor) {
            throw new InvalidArgumentException('Resulting money would be negative.');
        }
        return new self($this->currency, $this->amountMinor - $other->amountMinor);
    }

    /**
     * Ensure both amounts use the same currency code.
     */
    private function assertSameCurrency(self $other): void
    {
        if ($this->currency !== $other->currency) {
            throw new InvalidArgumentException('Currency mismatch.');
        }
    }
}
