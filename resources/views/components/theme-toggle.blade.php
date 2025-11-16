<label class="swap swap-rotate relative inline-flex items-center justify-center w-12 h-12 rounded-full cursor-pointer transition-all duration-300 theme-toggle-button">
    <input type="checkbox" class="theme-controller sr-only" value="dark" />
    <div class="swap-off flex items-center justify-center w-full h-full transition-opacity duration-300">
        @include('flux.icon.sun', ['variant' => 'mini'])
    </div>
    <div class="swap-on flex items-center justify-center w-full h-full transition-opacity duration-300">
        @include('flux.icon.moon', ['variant' => 'mini'])
    </div>
</label>

<script>
    // Theme toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const themeToggle = document.querySelector('.theme-controller');
        if (!themeToggle) return;
        
        const html = document.documentElement;
        const savedTheme = localStorage.getItem('theme') || 'light';
        
        // Set initial checkbox state
        themeToggle.checked = savedTheme === 'dark';
        
        themeToggle.addEventListener('change', (e) => {
            const isDark = e.target.checked;
            if (isDark) {
                html.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                html.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            }
        });
    });
</script>

