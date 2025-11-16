<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'meta_title',
        'meta_description',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($topic) {
            if (empty($topic->slug)) {
                $topic->slug = Str::slug($topic->title);
            }
        });

        static::updating(function ($topic) {
            if ($topic->isDirty('title') && empty($topic->slug)) {
                $topic->slug = Str::slug($topic->title);
            }
        });
    }

    public function hadith(): BelongsToMany
    {
        return $this->belongsToMany(Hadith::class, 'hadith_topics');
    }
}

