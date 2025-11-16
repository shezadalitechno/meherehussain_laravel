<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Collection;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function show(Collection $collection, Book $book, Chapter $chapter): \Illuminate\View\View
    {
        $chapter->load(['book.collection', 'hadith.collection', 'hadith.book']);
        
        return view('collections.book.chapter.show', compact('chapter'));
    }
}

