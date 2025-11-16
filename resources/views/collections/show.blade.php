@extends('layouts.app')

@section('title', $collection->title . ' - Mehere Hussain')

@section('content')
<div class="container mx-auto px-4 py-8">
    @include('components.breadcrumbs', [
        'items' => [
            ['label' => 'Collections', 'url' => route('collections.index')],
            ['label' => $collection->title]
        ]
    ])

    <div class="card rounded-3xl mb-8">
        <div class="card-body">
            <h1 class="text-4xl font-bold mb-4">{{ $collection->title }}</h1>
            <p class="text-lg mb-4">by <a href="{{ route('scholars.show', $collection->scholar) }}" class="link link-primary">{{ $collection->scholar->name }}</a></p>
            @if($collection->description)
                <div class="prose max-w-none">
                    @include('components.rich-text', ['content' => $collection->description])
                </div>
            @endif
        </div>
    </div>

    <h2 class="text-2xl font-bold mb-6">Books in this Collection</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($collection->books as $book)
            <div class="card rounded-3xl">
                <div class="card-body">
                    <h3 class="card-title">{{ $book->title }}</h3>
                    <p class="text-sm">Book {{ $book->book_number }}</p>
                    <div class="card-actions justify-end">
                        <a href="{{ route('books.show', ['collection' => $collection, 'book' => $book]) }}" class="btn btn-primary btn-sm rounded-full">View Book</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

