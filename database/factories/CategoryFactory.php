<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'parent_id' => null,
            'slug' => [
                'en' => $this->faker->slug,
                'ar' => $this->faker->slug,
            ],
        ];
    }

}
