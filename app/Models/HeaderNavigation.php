<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HeaderNavigation extends Model
{
    use HasFactory;

    protected $fillable = [
        'header_setting_id',
        'label',
        'link',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function headerSetting(): BelongsTo
    {
        return $this->belongsTo(HeaderSetting::class, 'header_setting_id');
    }
}

