@extends('layouts.app')

@section('title', 'Search - Mehere Hussain')

@section('content')
<div class="container mx-auto px-4 py-8">
    @include('components.breadcrumbs', ['items' => [['label' => 'Search']]])

    <h1 class="text-4xl font-bold mb-8">Search Hadith</h1>

    <div class="mb-8">
        @include('components.search-bar')
    </div>

    @if(request('q'))
        <div class="mb-4">
            <p class="text-lg">Search results for: <strong>{{ request('q') }}</strong></p>
            @if(isset($results) && $results->count() > 0)
                <p class="text-sm opacity-70">{{ $results->total() }} result(s) found</p>
            @endif
        </div>

        @if(isset($results) && $results->count() > 0)
            <div class="space-y-6">
                @foreach($results as $result)
                    @php
                        // If result is an array (from SearchService), convert to hadith model
                        $hadith = is_array($result) ? \App\Models\Hadith::with(['collection', 'book', 'chapter'])->find($result['id']) : $result;
                    @endphp
                    @if($hadith)
                        @include('components.hadith-card', ['hadith' => $hadith])
                    @endif
                @endforeach
            </div>

            <div class="mt-8">
                {{ $results->links() }}
            </div>
        @elseif(request('q'))
            <div class="alert alert-info">
                <span>No results found for your search query.</span>
            </div>
        @endif
    @endif
</div>
@endsection

