<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FooterSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'about_text',
        'contact_email',
        'contact_address',
        'contact_phone',
        'donate_link',
    ];

    protected $casts = [
        'about_text' => 'array',
    ];

    public function links(): HasMany
    {
        return $this->hasMany(FooterLink::class, 'footer_setting_id');
    }

    public function languages(): HasMany
    {
        return $this->hasMany(FooterLanguage::class, 'footer_setting_id');
    }
}

