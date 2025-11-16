@php
    $headerSetting = \App\Models\HeaderSetting::first();
    
    $structuredData = [
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => $headerSetting?->site_title ?? 'Mehere Hussain',
        'description' => $headerSetting?->tagline ?? 'The Hadith of the Prophet Muhammad (صلى الله عليه و سلم) at your fingertips',
        'url' => url('/'),
        'sameAs' => [],
    ];
    
    if ($headerSetting?->logo) {
        $structuredData['logo'] = asset('storage/' . $headerSetting->logo->filename);
    }
@endphp

<script type="application/ld+json">
{!! json_encode($structuredData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>

