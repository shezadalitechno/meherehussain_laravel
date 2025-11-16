@extends('layouts.app')

@section('title', 'Page Not Found - Mehere Hussain')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="text-center">
        <h1 class="text-6xl font-bold mb-4">404</h1>
        <h2 class="text-3xl font-bold mb-4">Page Not Found</h2>
        <p class="text-lg mb-8">The page you are looking for does not exist.</p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('home') }}" class="btn btn-primary">Go Home</a>
            <a href="{{ route('collections.index') }}" class="btn btn-outline">Browse Collections</a>
        </div>
    </div>
</div>
@endsection

