@php
    $headerSetting = \App\Models\HeaderSetting::first();
    $navigationItems = $headerSetting?->navigationItems()->orderBy('order')->get() ?? collect();
@endphp

<!-- Desktop Header -->
<header class="navbar hidden lg:flex">
    <div class="container mx-auto flex items-center justify-between w-full">
        <a href="{{ route('home') }}" class="btn btn-ghost text-xl rounded-full flex-shrink-0">
            @if($headerSetting?->logo)
                <img src="{{ asset('storage/' . $headerSetting->logo->filename) }}" alt="{{ $headerSetting->logo->alt }}" class="h-8 w-auto mr-2">
            @endif
            {{ $headerSetting?->site_title ?? 'Mehere Hussain' }}
        </a>
        <ul class="menu menu-horizontal px-1 flex items-center gap-2">
            @foreach($navigationItems as $item)
                <li>
                    <a href="{{ $item->link }}" class="btn btn-ghost rounded-full">{{ $item->label }}</a>
                </li>
            @endforeach
        </ul>
        <div class="flex-shrink-0">
            @include('components.theme-toggle')
        </div>
    </div>
</header>

