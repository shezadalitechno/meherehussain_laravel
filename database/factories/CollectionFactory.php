<?php

namespace Database\Factories;

use App\Models\Collection;
use App\Models\Scholar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collection>
 */
class CollectionFactory extends Factory
{
    protected $model = Collection::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'slug' => fake()->unique()->slug(),
            'description' => [
                'type' => 'doc',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => fake()->paragraph(),
                            ],
                        ],
                    ],
                ],
            ],
            'scholar_id' => Scholar::factory(),
            'publication_info' => fake()->sentence(),
        ];
    }
}

