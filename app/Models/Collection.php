<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'scholar_id',
        'publication_info',
    ];

    protected $casts = [
        'description' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($collection) {
            if (empty($collection->slug)) {
                $collection->slug = Str::slug($collection->title);
            }
        });

        static::updating(function ($collection) {
            if ($collection->isDirty('title') && empty($collection->slug)) {
                $collection->slug = Str::slug($collection->title);
            }
        });
    }

    public function scholar(): BelongsTo
    {
        return $this->belongsTo(Scholar::class);
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function tags()
    {
        return $this->hasMany(CollectionTag::class);
    }
}

