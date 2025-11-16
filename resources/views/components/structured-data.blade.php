@php
    $headerSetting = \App\Models\HeaderSetting::first();
@endphp

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "{{ $headerSetting?->site_title ?? 'Mehere Hussain' }}",
    "description": "{{ $headerSetting?->tagline ?? 'The Hadith of the Prophet Muhammad (صلى الله عليه و سلم) at your fingertips' }}",
    "url": "{{ url('/') }}",
    @if($headerSetting?->logo)
    "logo": "{{ asset('storage/' . $headerSetting->logo->filename) }}",
    @endif
    "sameAs": []
}
</script>

