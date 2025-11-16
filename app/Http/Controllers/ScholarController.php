<?php

namespace App\Http\Controllers;

use App\Models\Scholar;
use Illuminate\Http\Request;

class ScholarController extends Controller
{
    public function index()
    {
        $scholars = Scholar::withCount('collections')->paginate(12);
        
        return view('scholars.index', compact('scholars'));
    }

    public function show(Scholar $scholar)
    {
        $scholar->load(['collections.books']);
        
        return view('scholars.show', compact('scholar'));
    }
}

