@php
    $headerSetting = \App\Models\HeaderSetting::first();
    $navigationItems = $headerSetting?->navigationItems()->orderBy('order')->get() ?? collect();
@endphp

<header class="navbar bg-base-200 shadow-lg">
    <div class="container mx-auto">
        <div class="flex-1">
            <a href="{{ route('home') }}" class="btn btn-ghost text-xl">
                @if($headerSetting?->logo)
                    <img src="{{ asset('storage/' . $headerSetting->logo->filename) }}" alt="{{ $headerSetting->logo->alt }}" class="h-8 w-auto mr-2">
                @endif
                {{ $headerSetting?->site_title ?? 'Mehere Hussain' }}
            </a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1 hidden lg:flex">
                @foreach($navigationItems as $item)
                    <li>
                        <a href="{{ $item->link }}" class="btn btn-ghost">{{ $item->label }}</a>
                    </li>
                @endforeach
            </ul>
            <div class="dropdown dropdown-end lg:hidden">
                <div tabindex="0" role="button" class="btn btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </div>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                    @foreach($navigationItems as $item)
                        <li><a href="{{ $item->link }}">{{ $item->label }}</a></li>
                    @endforeach
                </ul>
            </div>
            @include('components.theme-toggle')
        </div>
    </div>
</header>

