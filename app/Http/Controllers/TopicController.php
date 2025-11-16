<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::withCount('hadith')->paginate(12);
        
        return view('topics.index', compact('topics'));
    }

    public function show(Topic $topic)
    {
        $topic->load(['hadith.collection', 'hadith.book', 'hadith.chapter']);
        $hadith = $topic->hadith()->paginate(20);
        
        return view('topics.show', compact('topic', 'hadith'));
    }
}

