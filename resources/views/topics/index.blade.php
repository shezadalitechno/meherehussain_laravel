@extends('layouts.app')

@section('title', 'Topics - Mehere Hussain')

@section('content')
<div class="container mx-auto px-4 py-8">
    @include('components.breadcrumbs', ['items' => [['label' => 'Topics']]])

    <h1 class="text-4xl font-bold mb-8">Hadith Topics</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($topics as $topic)
            <div class="card rounded-3xl">
                <div class="card-body">
                    <h2 class="card-title">{{ $topic->title }}</h2>
                    @if($topic->description)
                        <p class="text-sm">{{ $topic->description }}</p>
                    @endif
                    <p class="text-sm opacity-70">{{ $topic->hadith_count }} hadith</p>
                    <div class="card-actions justify-end">
                        <a href="{{ route('topics.show', $topic) }}" class="btn btn-primary rounded-full">View Topic</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $topics->links() }}
    </div>
</div>
@endsection

