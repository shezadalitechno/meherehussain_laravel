@extends('layouts.app')

@section('title', $page->title . ' - Mehere Hussain')

@section('content')
<div class="container mx-auto px-4 py-8">
    @include('components.breadcrumbs', ['items' => [['label' => $page->title]]])

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h1 class="text-4xl font-bold mb-6">{{ $page->title }}</h1>
            <div class="prose prose-lg max-w-none">
                @include('components.rich-text', ['content' => $page->content])
            </div>
        </div>
    </div>
</div>
@endsection

