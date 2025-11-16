@props(['collection'])

<div class="card bg-base-100 shadow-xl">
    <div class="card-body">
        <h2 class="card-title">{{ $collection->title }}</h2>
        <p class="text-sm text-base-content/70">by {{ $collection->scholar->name }}</p>
        @if($collection->description)
            <div class="prose prose-sm max-w-none">
                @include('components.rich-text', ['content' => $collection->description])
            </div>
        @endif
        <div class="card-actions justify-end">
            <a href="{{ route('collections.show', $collection) }}" class="btn btn-primary">View Collection</a>
        </div>
    </div>
</div>

