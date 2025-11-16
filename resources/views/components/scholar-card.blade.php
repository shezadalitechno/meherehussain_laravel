@props(['scholar'])

<div class="card rounded-3xl">
    <div class="card-body">
        <h2 class="card-title">{{ $scholar->name }}</h2>
        @if($scholar->era)
            <p class="text-sm opacity-70">{{ $scholar->era }}</p>
        @endif
        @if($scholar->biography)
            <div class="prose prose-sm max-w-none">
                @include('components.rich-text', ['content' => $scholar->biography])
            </div>
        @endif
        <div class="card-actions justify-end">
            <a href="{{ route('scholars.show', $scholar) }}" class="btn btn-primary rounded-full">View Scholar</a>
        </div>
    </div>
</div>

