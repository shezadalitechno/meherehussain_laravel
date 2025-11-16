@extends('layouts.app')

@section('title', 'Server Error - Mehere Hussain')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="text-center">
        <h1 class="text-6xl font-bold mb-4">500</h1>
        <h2 class="text-3xl font-bold mb-4">Server Error</h2>
        <p class="text-lg mb-8">Something went wrong on our end. Please try again later.</p>
        <div class="flex justify-center gap-4">
            <a href="{{ route('home') }}" class="btn btn-primary rounded-full">Go Home</a>
            <button onclick="window.location.reload()" class="btn btn-outline rounded-full">Reload Page</button>
        </div>
    </div>
</div>
@endsection

