<?php

namespace Database\Factories;

use App\Models\Hadith;
use App\Models\HadithNarrator;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HadithNarrator>
 */
class HadithNarratorFactory extends Factory
{
    protected $model = HadithNarrator::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hadith_id' => Hadith::factory(),
            'narrator' => fake()->name(),
        ];
    }
}

