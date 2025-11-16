@extends('layouts.app')

@section('title', $topic->title . ' - Mehere Hussain')

@section('content')
<div class="container mx-auto px-4 py-8">
    @include('components.breadcrumbs', [
        'items' => [
            ['label' => 'Topics', 'url' => route('topics.index')],
            ['label' => $topic->title]
        ]
    ])

    <div class="card rounded-3xl mb-8">
        <div class="card-body">
            <h1 class="text-4xl font-bold mb-4">{{ $topic->title }}</h1>
            @if($topic->description)
                <p class="text-lg">{{ $topic->description }}</p>
            @endif
        </div>
    </div>

    <h2 class="text-2xl font-bold mb-6">Related Hadith</h2>
    <div class="space-y-6">
        @foreach($hadith as $item)
            @include('components.hadith-card', ['hadith' => $item])
        @endforeach
    </div>

    <div class="mt-8">
        {{ $hadith->links() }}
    </div>
</div>
@endsection

