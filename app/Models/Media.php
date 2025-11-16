<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'alt',
        'filename',
        'mime_type',
        'filesize',
        'width',
        'height',
        'focal_x',
        'focal_y',
    ];

    protected $casts = [
        'filesize' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
        'focal_x' => 'decimal:2',
        'focal_y' => 'decimal:2',
    ];
}

