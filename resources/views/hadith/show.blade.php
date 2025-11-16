@extends('layouts.app')

@section('title', 'Hadith ' . $hadith->reference_number . ' - Mehere Hussain')

@section('content')
<div class="container mx-auto px-4 py-8">
    @include('components.breadcrumbs', [
        'items' => [
            ['label' => 'Collections', 'url' => route('collections.index')],
            ['label' => $hadith->collection->title, 'url' => route('collections.show', $hadith->collection)],
            ['label' => $hadith->book->title, 'url' => route('books.show', ['collection' => $hadith->collection, 'book' => $hadith->book])],
            ['label' => $hadith->chapter->title, 'url' => route('chapters.show', ['collection' => $hadith->collection, 'book' => $hadith->book, 'chapter' => $hadith->chapter])],
            ['label' => 'Hadith ' . $hadith->reference_number]
        ]
    ])

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="flex justify-between items-start mb-4">
                <h1 class="text-3xl font-bold">
                    Hadith {{ $hadith->reference_number }}
                </h1>
                @if($hadith->grade)
                    <span class="badge badge-lg badge-{{ $hadith->grade === 'Sahih' ? 'success' : ($hadith->grade === 'Hasan' ? 'info' : 'warning') }}">
                        {{ $hadith->grade }}
                    </span>
                @endif
            </div>

            <div class="mb-6">
                <div class="text-sm text-base-content/70 mb-4">
                    <p><strong>Collection:</strong> <a href="{{ route('collections.show', $hadith->collection) }}" class="link link-primary">{{ $hadith->collection->title }}</a></p>
                    <p><strong>Book:</strong> <a href="{{ route('books.show', ['collection' => $hadith->collection, 'book' => $hadith->book]) }}" class="link link-primary">{{ $hadith->book->title }}</a></p>
                    <p><strong>Chapter:</strong> <a href="{{ route('chapters.show', ['collection' => $hadith->collection, 'book' => $hadith->book, 'chapter' => $hadith->chapter]) }}" class="link link-primary">{{ $hadith->chapter->title }}</a></p>
                </div>
            </div>

            <div class="divider"></div>

            <div class="mb-6">
                <h2 class="text-2xl font-bold mb-4">Arabic Text</h2>
                <div class="arabic-text text-2xl leading-relaxed" dir="rtl" lang="ar" style="font-family: var(--font-arabic);">
                    @include('components.rich-text', ['content' => $hadith->text_arabic])
                </div>
            </div>

            <div class="divider"></div>

            <div class="mb-6">
                <h2 class="text-2xl font-bold mb-4">English Translation</h2>
                <div class="prose prose-lg max-w-none">
                    @include('components.rich-text', ['content' => $hadith->text_english])
                </div>
            </div>

            @if($hadith->text_hinglish)
                <div class="divider"></div>
                <div class="mb-6">
                    <h2 class="text-2xl font-bold mb-4">Hinglish Translation</h2>
                    <div class="prose prose-lg max-w-none">
                        @include('components.rich-text', ['content' => $hadith->text_hinglish])
                    </div>
                </div>
            @endif

            @if($hadith->text_urdu)
                <div class="divider"></div>
                <div class="mb-6">
                    <h2 class="text-2xl font-bold mb-4">Urdu Translation</h2>
                    <div class="prose prose-lg max-w-none" dir="rtl" lang="ur" style="font-family: var(--font-urdu);">
                        @include('components.rich-text', ['content' => $hadith->text_urdu])
                    </div>
                </div>
            @endif

            @if($hadith->text_hindi)
                <div class="divider"></div>
                <div class="mb-6">
                    <h2 class="text-2xl font-bold mb-4">Hindi Translation</h2>
                    <div class="prose prose-lg max-w-none">
                        @include('components.rich-text', ['content' => $hadith->text_hindi])
                    </div>
                </div>
            @endif

            @if($hadith->narrators->isNotEmpty())
                <div class="divider"></div>
                <div class="mb-6">
                    <h2 class="text-2xl font-bold mb-4">Narrators</h2>
                    <ul class="list-disc list-inside">
                        @foreach($hadith->narrators as $narrator)
                            <li>{{ $narrator->narrator }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($hadith->topics->isNotEmpty())
                <div class="divider"></div>
                <div class="mb-6">
                    <h2 class="text-2xl font-bold mb-4">Topics</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach($hadith->topics as $topic)
                            <a href="{{ route('topics.show', $topic) }}" class="badge badge-primary badge-lg">{{ $topic->title }}</a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

