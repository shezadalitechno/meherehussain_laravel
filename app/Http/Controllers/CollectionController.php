<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::with('scholar')->paginate(12);
        
        return view('collections.index', compact('collections'));
    }

    public function show(Collection $collection)
    {
        $collection->load(['scholar', 'books.chapters']);
        
        return view('collections.show', compact('collection'));
    }
}

