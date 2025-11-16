<label class="swap swap-rotate btn btn-ghost btn-circle !p-2">
    <input type="checkbox" class="theme-controller" value="dark" />
    <div class="swap-off size-5">
        @include('flux.icon.sun', ['variant' => 'mini'])
    </div>
    <div class="swap-on size-5">
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

