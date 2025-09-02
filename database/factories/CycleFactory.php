<?php

namespace Database\Factories;

use App\Models\Cycle;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<Cycle>
 */
class CycleFactory extends Factory
{
    protected $model = Cycle::class;

    public function definition(): array
    {
        $start = Carbon::instance($this->faker->dateTimeThisMonth())->startOfMinute();
        $start->minute(($start->minute - ($start->minute % 10)));
        $end = (clone $start)->addMinutes(10);

        return [
            'window_start' => $start,
            'window_end' => $end,
            'total_net_amount' => $this->faker->randomFloat(2, 0, 5000),
            'status' => $this->faker->randomElement(['pending', 'suspended', 'scheduled', 'closed']),
        ];
    }
}
