@extends('layouts.app')

@section('title', $scholar->name . ' - Mehere Hussain')

@section('content')
<div class="container mx-auto px-4 py-8">
    @include('components.breadcrumbs', [
        'items' => [
            ['label' => 'Scholars', 'url' => route('scholars.index')],
            ['label' => $scholar->name]
        ]
    ])

    <div class="card bg-base-100 shadow-xl mb-8">
        <div class="card-body">
            <h1 class="text-4xl font-bold mb-4">{{ $scholar->name }}</h1>
            @if($scholar->era)
                <p class="text-lg mb-4">{{ $scholar->era }}</p>
            @endif
            @if($scholar->biography)
                <div class="prose max-w-none">
                    @include('components.rich-text', ['content' => $scholar->biography])
                </div>
            @endif
        </div>
    </div>

    <h2 class="text-2xl font-bold mb-6">Collections</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach($scholar->collections as $collection)
            @include('components.collection-card', ['collection' => $collection])
        @endforeach
    </div>
</div>
@endsection

