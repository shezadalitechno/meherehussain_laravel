<?php

namespace App\Console\Commands;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Collection;
use App\Models\CollectionTag;
use App\Models\Hadith;
use App\Models\HadithNarrator;
use App\Models\Scholar;
use App\Models\Topic;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImportHadithData extends Command
{
    protected $signature = 'hadith:import {file : Path to JSON file}';
    protected $description = 'Import hadith data from JSON file';

    public function handle()
    {
        $filePath = $this->argument('file');
        
        if (!file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return 1;
        }

        $data = json_decode(file_get_contents($filePath), true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Invalid JSON file: ' . json_last_error_msg());
            return 1;
        }

        DB::beginTransaction();
        
        try {
            // Create or get scholar
            $scholar = Scholar::firstOrCreate(
                ['slug' => Str::slug($data['collection']['scholar'])],
                ['name' => $data['collection']['scholar']]
            );

            // Create collection
            $collection = Collection::firstOrCreate(
                ['slug' => $data['collection']['slug']],
                [
                    'title' => $data['collection']['title'],
                    'scholar_id' => $scholar->id,
                    'description' => $this->convertToTipTap($data['collection']['description'] ?? ''),
                    'publication_info' => $data['collection']['publicationInfo'] ?? null,
                ]
            );

            // Add tags
            if (isset($data['collection']['tags']) && is_array($data['collection']['tags'])) {
                foreach ($data['collection']['tags'] as $tag) {
                    CollectionTag::firstOrCreate([
                        'collection_id' => $collection->id,
                        'tag' => $tag,
                    ]);
                }
            }

            // Process books
            foreach ($data['books'] ?? [] as $bookData) {
                $book = Book::firstOrCreate(
                    [
                        'collection_id' => $collection->id,
                        'slug' => $bookData['slug'],
                    ],
                    [
                        'title' => $bookData['title'],
                        'book_number' => $bookData['bookNumber'],
                        'description' => $this->convertToTipTap($bookData['description'] ?? ''),
                    ]
                );

                // Process chapters
                foreach ($bookData['chapters'] ?? [] as $chapterData) {
                    $chapter = Chapter::firstOrCreate(
                        [
                            'book_id' => $book->id,
                            'slug' => $chapterData['slug'],
                        ],
                        [
                            'title' => $chapterData['title'],
                            'chapter_number' => $chapterData['chapterNumber'],
                            'description' => $this->convertToTipTap($chapterData['description'] ?? ''),
                        ]
                    );

                    // Process hadith
                    foreach ($chapterData['hadiths'] ?? [] as $hadithData) {
                        $hadith = Hadith::create([
                            'collection_id' => $collection->id,
                            'book_id' => $book->id,
                            'chapter_id' => $chapter->id,
                            'reference_number' => $hadithData['referenceNumber'],
                            'text_arabic' => $this->convertToTipTap($hadithData['textArabic'] ?? ''),
                            'text_english' => $this->convertToTipTap($hadithData['textEnglish'] ?? ''),
                            'text_hinglish' => $this->convertToTipTap($hadithData['textHinglish'] ?? ''),
                            'text_urdu' => isset($hadithData['textUrdu']) ? $this->convertToTipTap($hadithData['textUrdu']) : null,
                            'text_hindi' => isset($hadithData['textHindi']) ? $this->convertToTipTap($hadithData['textHindi']) : null,
                            'grade' => $hadithData['grade'] ?? null,
                        ]);

                        // Add narrators
                        if (isset($hadithData['narrators']) && is_array($hadithData['narrators'])) {
                            foreach ($hadithData['narrators'] as $narrator) {
                                HadithNarrator::create([
                                    'hadith_id' => $hadith->id,
                                    'narrator' => $narrator,
                                ]);
                            }
                        }

                        // Attach topics
                        if (isset($hadithData['topics']) && is_array($hadithData['topics'])) {
                            foreach ($hadithData['topics'] as $topicName) {
                                $topic = Topic::firstOrCreate(
                                    ['slug' => Str::slug($topicName)],
                                    ['title' => $topicName]
                                );
                                $hadith->topics()->syncWithoutDetaching([$topic->id]);
                            }
                        }
                    }
                }
            }

            DB::commit();
            $this->info('Data imported successfully!');
            return 0;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Error importing data: ' . $e->getMessage());
            return 1;
        }
    }

    protected function convertToTipTap(string $text): array
    {
        if (empty($text)) {
            return [
                'type' => 'doc',
                'content' => [],
            ];
        }

        // Split text into paragraphs
        $paragraphs = array_filter(explode("\n\n", $text));
        
        $content = [];
        foreach ($paragraphs as $paragraph) {
            $content[] = [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => trim($paragraph),
                    ],
                ],
            ];
        }

        return [
            'type' => 'doc',
            'content' => $content,
        ];
    }
}

