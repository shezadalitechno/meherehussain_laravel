@props(['text', 'class' => ''])

<div class="arabic-text {{ $class }}" dir="rtl" lang="ar" style="font-family: var(--font-arabic);">
    {{ $text }}
</div>

