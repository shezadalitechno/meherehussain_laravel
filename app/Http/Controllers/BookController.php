<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Collection;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function show(Collection $collection, Book $book): \Illuminate\View\View
    {
        $book->load(['collection', 'chapters']);
        
        return view('collections.book.show', compact('book'));
    }
}

