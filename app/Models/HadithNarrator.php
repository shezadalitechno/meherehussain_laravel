<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HadithNarrator extends Model
{
    use HasFactory;

    protected $fillable = [
        'hadith_id',
        'narrator',
    ];

    public function hadith(): BelongsTo
    {
        return $this->belongsTo(Hadith::class);
    }
}

