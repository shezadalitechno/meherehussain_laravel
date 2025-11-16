<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Hadith;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $collections = Collection::with('scholar')->latest()->take(6)->get();
        $recentHadith = Hadith::with(['collection', 'book', 'chapter'])->latest()->take(5)->get();
        
        return view('home', compact('collections', 'recentHadith'));
    }
}

