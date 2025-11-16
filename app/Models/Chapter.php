<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'book_id',
        'chapter_number',
        'description',
    ];

    protected $casts = [
        'description' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($chapter) {
            if (empty($chapter->slug)) {
                $chapter->slug = Str::slug($chapter->title);
            }
        });

        static::updating(function ($chapter) {
            if ($chapter->isDirty('title') && empty($chapter->slug)) {
                $chapter->slug = Str::slug($chapter->title);
            }
        });
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function hadith(): HasMany
    {
        return $this->hasMany(Hadith::class);
    }
}

