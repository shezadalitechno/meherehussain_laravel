<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FooterLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'footer_setting_id',
        'language',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    public function footerSetting(): BelongsTo
    {
        return $this->belongsTo(FooterSetting::class, 'footer_setting_id');
    }
}

