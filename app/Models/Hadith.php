<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hadith extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_id',
        'book_id',
        'chapter_id',
        'text_arabic',
        'text_english',
        'text_hinglish',
        'text_urdu',
        'text_hindi',
        'reference_number',
        'grade',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'text_arabic' => 'array',
        'text_english' => 'array',
        'text_hinglish' => 'array',
        'text_urdu' => 'array',
        'text_hindi' => 'array',
    ];

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    public function narrators(): HasMany
    {
        return $this->hasMany(HadithNarrator::class);
    }

    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(Topic::class, 'hadith_topics');
    }

    /**
     * Extract plain text from TipTap JSON structure
     */
    public function extractTextFromTipTap(array $content): string
    {
        if (empty($content) || !isset($content['content'])) {
            return '';
        }

        $text = '';
        foreach ($content['content'] ?? [] as $node) {
            if (isset($node['content'])) {
                foreach ($node['content'] as $child) {
                    if (isset($child['text'])) {
                        $text .= $child['text'] . ' ';
                    }
                }
            } elseif (isset($node['text'])) {
                $text .= $node['text'] . ' ';
            }
        }

        return trim($text);
    }
}

