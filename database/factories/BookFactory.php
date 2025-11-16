<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(4, true),
            'slug' => fake()->unique()->slug(),
            'collection_id' => Collection::factory(),
            'book_number' => fake()->numberBetween(1, 100),
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
        ];
    }
}

