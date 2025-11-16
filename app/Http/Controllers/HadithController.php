<?php

namespace App\Http\Controllers;

use App\Models\Hadith;
use Illuminate\Http\Request;

class HadithController extends Controller
{
    public function show(Hadith $hadith)
    {
        $hadith->load(['collection', 'book', 'chapter', 'topics', 'narrators']);
        
        return view('hadith.show', compact('hadith'));
    }
}

