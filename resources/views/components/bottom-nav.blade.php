@php
    $headerSetting = \App\Models\HeaderSetting::first();
    $navigationItems = $headerSetting?->navigationItems()->orderBy('order')->get() ?? collect();
    $footerSetting = \App\Models\FooterSetting::first();
    $footerLinks = $footerSetting?->links()->orderBy('order')->get() ?? collect();
    $pages = \App\Models\Page::all();
    
    // Get current route for active state
    $currentRoute = request()->route()->getName() ?? '';
    $isHome = $currentRoute === 'home' || request()->path() === '/';
@endphp

<nav class="bottom-nav fixed bottom-0 left-0 right-0 z-[100] lg:hidden" style="display: block !important; visibility: visible !important; opacity: 1 !important;">
    <div class="flex justify-center items-center h-14 px-2 min-h-[56px] gap-2">
        <!-- Home Button -->
        <a 
            href="{{ route('home') }}" 
            class="bottom-nav-item relative flex flex-col items-center justify-center w-14 h-14 transition-all rounded-3xl neumorphic text-[var(--color-neu-text)] opacity-70 neumorphic-hover neumorphic-active {{ $isHome ? 'neumorphic-pressed opacity-100' : '' }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="text-[10px] font-medium leading-tight">Home</span>
            @if($isHome)
                <div class="absolute bottom-1 left-1/2 transform -translate-x-1/2 w-10 h-1.5 rounded-full neumorphic-indicator"></div>
            @endif
        </a>

        <!-- Main Navigation Items -->
        @foreach($navigationItems as $item)
            @php
                $isActive = false;
                
                // Try to match route name from link
                if (str_starts_with($item->link, '/')) {
                    $path = parse_url($item->link, PHP_URL_PATH);
                    if ($path === '/') {
                        $isActive = $currentRoute === 'home' || request()->path() === '/';
                    } elseif ($path === '/collections') {
                        $isActive = str_starts_with($currentRoute, 'collections.') || request()->path() === 'collections';
                    } elseif ($path === '/scholars') {
                        $isActive = str_starts_with($currentRoute, 'scholars.') || request()->path() === 'scholars';
                    } elseif ($path === '/topics') {
                        $isActive = str_starts_with($currentRoute, 'topics.') || request()->path() === 'topics';
                    } elseif ($path === '/search') {
                        $isActive = $currentRoute === 'search.index' || request()->path() === 'search';
                    } else {
                        $isActive = request()->path() === ltrim($path, '/');
                    }
                }
                
                // Determine icon based on label or link
                $icon = 'home';
                $label = strtolower($item->label);
                if (str_contains($label, 'home') || $item->link === '/' || $item->link === route('home')) {
                    $icon = 'home';
                } elseif (str_contains($label, 'collection') || str_contains($item->link, 'collection')) {
                    $icon = 'book';
                } elseif (str_contains($label, 'scholar') || str_contains($item->link, 'scholar')) {
                    $icon = 'user';
                } elseif (str_contains($label, 'topic') || str_contains($item->link, 'topic')) {
                    $icon = 'tag';
                } elseif (str_contains($label, 'search') || str_contains($item->link, 'search')) {
                    $icon = 'magnifying-glass';
                }
            @endphp
            <a 
                href="{{ $item->link }}" 
                class="bottom-nav-item relative flex flex-col items-center justify-center w-14 h-14 transition-all rounded-3xl neumorphic text-[var(--color-neu-text)] opacity-70 neumorphic-hover neumorphic-active {{ $isActive ? 'neumorphic-pressed opacity-100' : '' }}"
            >
                @if($icon === 'home')
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                @elseif($icon === 'book')
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                @elseif($icon === 'user')
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                @elseif($icon === 'tag')
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                @elseif($icon === 'magnifying-glass')
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                @endif
                <span class="text-[10px] font-medium leading-tight">{{ $item->label }}</span>
                @if($isActive)
                    <div class="absolute bottom-1 left-1/2 transform -translate-x-1/2 w-10 h-1.5 rounded-full neumorphic-indicator"></div>
                @endif
            </a>
        @endforeach

        <!-- More Menu Button -->
        <div class="relative bottom-nav-more-menu" data-dropdown="more-menu">
            <button 
                type="button"
                class="bottom-nav-item relative flex flex-col items-center justify-center w-14 h-14 transition-all rounded-3xl neumorphic text-[var(--color-neu-text)] opacity-70 neumorphic-hover neumorphic-active"
                data-dropdown-toggle="more-menu"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5zM18.75 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM18.75 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM18.75 18.75a.75.75 0 110-1.5.75.75 0 010 1.5zM5.25 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM5.25 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM5.25 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z" />
                </svg>
                <span class="text-[10px] font-medium leading-tight">More</span>
            </button>
            <div 
                data-dropdown-menu="more-menu"
                class="bottom-nav-dropdown absolute bottom-full right-0 mb-2 p-2 rounded-2xl w-48 min-w-max z-[102] hidden"
            >
                <ul class="menu menu-sm w-full">
                @if($footerLinks->isNotEmpty())
                    @foreach($footerLinks as $link)
                        <li class="w-full">
                            <a href="{{ $link->link }}" data-dropdown-close class="bottom-nav-dropdown-item rounded-xl w-full">
                                <span class="text-sm">{{ $link->label }}</span>
                            </a>
                        </li>
                    @endforeach
                @endif
                
                @if($pages->isNotEmpty())
                    @foreach($pages as $page)
                        <li class="w-full">
                            <a href="{{ route('pages.show', $page) }}" data-dropdown-close class="bottom-nav-dropdown-item rounded-xl w-full">
                                <span class="text-sm">{{ $page->title }}</span>
                            </a>
                        </li>
                    @endforeach
                @endif
                
                <li class="w-full">
                    <a href="{{ route('contact.index') }}" data-dropdown-close class="bottom-nav-dropdown-item rounded-xl w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                        <span class="text-sm">Contact</span>
                    </a>
                </li>
                
                <li class="w-full">
                    <a href="{{ route('search.index') }}" data-dropdown-close class="bottom-nav-dropdown-item rounded-xl w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span class="text-sm">Search</span>
                    </a>
                </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Dropdown functionality
    const toggleButtons = document.querySelectorAll('[data-dropdown-toggle]');
    const dropdownMenus = document.querySelectorAll('[data-dropdown-menu]');
    const closeButtons = document.querySelectorAll('[data-dropdown-close]');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            const targetId = this.getAttribute('data-dropdown-toggle');
            const menu = document.querySelector(`[data-dropdown-menu="${targetId}"]`);
            
            // Close all other menus
            dropdownMenus.forEach(m => {
                if (m !== menu) {
                    m.classList.add('hidden');
                }
            });
            
            // Toggle current menu
            if (menu) {
                menu.classList.toggle('hidden');
            }
        });
    });
    
    // Close on outside click
    document.addEventListener('click', function(e) {
        if (!e.target.closest('[data-dropdown]')) {
            dropdownMenus.forEach(menu => {
                menu.classList.add('hidden');
            });
        }
    });
    
    // Close on link click
    closeButtons.forEach(button => {
        button.addEventListener('click', function() {
            dropdownMenus.forEach(menu => {
                menu.classList.add('hidden');
            });
        });
    });
});
</script>

