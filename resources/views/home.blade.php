@extends('layouts.app')

@section('title', 'Home - Mehere Hussain')
@section('description', 'The Hadith of the Prophet Muhammad (صلى الله عليه و سلم) at your fingertips')

@section('content')
<div class="hero bg-base-200 py-16">
    <div class="hero-content text-center">
        <div class="max-w-md">
            <h1 class="text-5xl font-bold">Mehere Hussain</h1>
            <p class="py-6">The Hadith of the Prophet Muhammad (صلى الله عليه و سلم) at your fingertips</p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('collections.index') }}" class="btn btn-primary">Browse Collections</a>
                <a href="{{ route('search.index') }}" class="btn btn-outline">Search Hadith</a>
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        @include('components.search-bar')
    </div>

    <section class="mb-12">
        <h2 class="text-3xl font-bold mb-6">Featured Collections</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($collections as $collection)
                @include('components.collection-card', ['collection' => $collection])
            @endforeach
        </div>
        <div class="text-center mt-6">
            <a href="{{ route('collections.index') }}" class="btn btn-outline">View All Collections</a>
        </div>
    </section>

    <section>
        <h2 class="text-3xl font-bold mb-6">Recent Hadith</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($recentHadith as $hadith)
                @include('components.hadith-card', ['hadith' => $hadith])
            @endforeach
        </div>
    </section>
</div>
@endsection

