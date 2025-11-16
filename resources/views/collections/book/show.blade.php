@extends('layouts.app')

@section('title', $book->title . ' - Mehere Hussain')

@section('content')
<div class="container mx-auto px-4 py-8">
    @include('components.breadcrumbs', [
        'items' => [
            ['label' => 'Collections', 'url' => route('collections.index')],
            ['label' => $book->collection->title, 'url' => route('collections.show', $book->collection)],
            ['label' => $book->title]
        ]
    ])

    <div class="card bg-base-100 shadow-xl mb-8">
        <div class="card-body">
            <h1 class="text-4xl font-bold mb-4">{{ $book->title }}</h1>
            <p class="text-lg mb-4">Book {{ $book->book_number }} of <a href="{{ route('collections.show', $book->collection) }}" class="link link-primary">{{ $book->collection->title }}</a></p>
            @if($book->description)
                <div class="prose max-w-none">
                    @include('components.rich-text', ['content' => $book->description])
                </div>
            @endif
        </div>
    </div>

    <h2 class="text-2xl font-bold mb-6">Chapters</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($book->chapters as $chapter)
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <h3 class="card-title">{{ $chapter->title }}</h3>
                    <p class="text-sm">Chapter {{ $chapter->chapter_number }}</p>
                    <div class="card-actions justify-end">
                        <a href="{{ route('chapters.show', ['collection' => $book->collection, 'book' => $book, 'chapter' => $chapter]) }}" class="btn btn-primary btn-sm">View Chapter</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

