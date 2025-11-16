<form action="{{ route('search.index') }}" method="GET" class="w-full flex items-center gap-3">
    <div class="relative flex-1">
        <input 
            type="text" 
            name="q" 
            placeholder="Search hadith..." 
            class="input input-bordered w-full px-6 py-7 text-base rounded-full" 
            value="{{ request('q') }}"
            autocomplete="off"
        />
    </div>
    <button 
        type="submit" 
        class="btn btn-primary rounded-full px-6 py-7 flex-shrink-0"
        aria-label="Search"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </button>
</form>

