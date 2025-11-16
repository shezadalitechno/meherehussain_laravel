<?php

namespace Database\Factories;

use App\Models\Chapter;
use App\Models\Collection;
use App\Models\Hadith;
use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hadith>
 */
class HadithFactory extends Factory
{
    protected $model = Hadith::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipTapStructure = [
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
        ];

        return [
            'collection_id' => Collection::factory(),
            'book_id' => Book::factory(),
            'chapter_id' => Chapter::factory(),
            'text_arabic' => $tipTapStructure,
            'text_english' => $tipTapStructure,
            'text_hinglish' => $tipTapStructure,
            'text_urdu' => $tipTapStructure,
            'text_hindi' => $tipTapStructure,
            'reference_number' => fake()->numberBetween(1, 10000),
            'grade' => fake()->randomElement(['Sahih', 'Hasan', 'Daif', 'Mawdu']),
        ];
    }
}

