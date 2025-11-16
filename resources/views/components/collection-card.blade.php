@props(['collection'])

<div class="card rounded-3xl">
    <div class="card-body">
        <h2 class="card-title">{{ $collection->title }}</h2>
        <p class="text-sm opacity-70">by {{ $collection->scholar->name }}</p>
        @if($collection->description)
            <div class="prose prose-sm max-w-none">
                @include('components.rich-text', ['content' => $collection->description])
            </div>
        @endif
        <div class="card-actions justify-end">
            <a href="{{ route('collections.show', $collection) }}" class="btn btn-primary rounded-full">View Collection</a>
        </div>
    </div>
</div>

