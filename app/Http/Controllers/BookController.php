<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function show(Book $book)
    {
        $book->load(['collection', 'chapters']);
        
        return view('collections.book.show', compact('book'));
    }
}

