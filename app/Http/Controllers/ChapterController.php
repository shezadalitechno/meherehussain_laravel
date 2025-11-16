<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function show(Chapter $chapter)
    {
        $chapter->load(['book.collection', 'hadith.collection', 'hadith.book']);
        
        return view('collections.book.chapter.show', compact('chapter'));
    }
}

