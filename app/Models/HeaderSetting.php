<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HeaderSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo_id',
        'site_title',
        'tagline',
    ];

    public function logo(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'logo_id');
    }

    public function navigationItems(): HasMany
    {
        return $this->hasMany(HeaderNavigation::class, 'header_setting_id');
    }
}

