<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Scholar extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'biography',
        'era',
    ];

    protected $casts = [
        'biography' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($scholar) {
            if (empty($scholar->slug)) {
                $scholar->slug = Str::slug($scholar->name);
            }
        });

        static::updating(function ($scholar) {
            if ($scholar->isDirty('name') && empty($scholar->slug)) {
                $scholar->slug = Str::slug($scholar->name);
            }
        });
    }

    public function collections(): HasMany
    {
        return $this->hasMany(Collection::class);
    }
}

