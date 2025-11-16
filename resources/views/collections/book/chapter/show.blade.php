@extends('layouts.app')

@section('title', $chapter->title . ' - Mehere Hussain')

@section('content')
<div class="container mx-auto px-4 py-8">
    @include('components.breadcrumbs', [
        'items' => [
            ['label' => 'Collections', 'url' => route('collections.index')],
            ['label' => $chapter->book->collection->title, 'url' => route('collections.show', $chapter->book->collection)],
            ['label' => $chapter->book->title, 'url' => route('books.show', ['collection' => $chapter->book->collection, 'book' => $chapter->book])],
            ['label' => $chapter->title]
        ]
    ])

    <div class="card rounded-3xl mb-8">
        <div class="card-body">
            <h1 class="text-4xl font-bold mb-4">{{ $chapter->title }}</h1>
            <p class="text-lg mb-4">Chapter {{ $chapter->chapter_number }} of <a href="{{ route('books.show', ['collection' => $chapter->book->collection, 'book' => $chapter->book]) }}" class="link link-primary">{{ $chapter->book->title }}</a></p>
            @if($chapter->description)
                <div class="prose max-w-none">
                    @include('components.rich-text', ['content' => $chapter->description])
                </div>
            @endif
        </div>
    </div>

    <h2 class="text-2xl font-bold mb-6">Hadith in this Chapter</h2>
    <div class="space-y-6">
        @foreach($chapter->hadith as $hadith)
            @include('components.hadith-card', ['hadith' => $hadith])
        @endforeach
    </div>
</div>
@endsection

