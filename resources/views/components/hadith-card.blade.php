@props(['hadith'])

<div class="card bg-base-100 shadow-xl">
    <div class="card-body">
        <div class="flex justify-between items-start mb-4">
            <h2 class="card-title">
                <span class="badge badge-primary">{{ $hadith->reference_number }}</span>
                @if($hadith->grade)
                    <span class="badge badge-{{ $hadith->grade === 'Sahih' ? 'success' : ($hadith->grade === 'Hasan' ? 'info' : 'warning') }}">
                        {{ $hadith->grade }}
                    </span>
                @endif
            </h2>
        </div>
        
        <div class="mb-4">
            <div class="arabic-text text-xl mb-4" dir="rtl" lang="ar" style="font-family: var(--font-arabic);">
                @include('components.rich-text', ['content' => $hadith->text_arabic])
            </div>
            
            <div class="text-sm text-base-content/70">
                <p><strong>Collection:</strong> {{ $hadith->collection->title }}</p>
                <p><strong>Book:</strong> {{ $hadith->book->title }}</p>
                <p><strong>Chapter:</strong> {{ $hadith->chapter->title }}</p>
            </div>
        </div>
        
        <div class="card-actions justify-end">
            <a href="{{ route('hadith.show', $hadith) }}" class="btn btn-primary btn-sm">Read More</a>
        </div>
    </div>
</div>

