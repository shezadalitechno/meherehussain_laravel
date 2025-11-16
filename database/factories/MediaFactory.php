<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'alt' => fake()->sentence(),
            'filename' => fake()->uuid() . '.jpg',
            'mime_type' => 'image/jpeg',
            'filesize' => fake()->numberBetween(10000, 1000000),
            'width' => fake()->numberBetween(100, 2000),
            'height' => fake()->numberBetween(100, 2000),
            'focal_x' => fake()->randomFloat(2, 0, 100),
            'focal_y' => fake()->randomFloat(2, 0, 100),
        ];
    }
}

