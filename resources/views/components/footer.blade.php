@php
    $footerSetting = \App\Models\FooterSetting::first();
    $footerLinks = $footerSetting?->links()->orderBy('order')->get() ?? collect();
    $footerLanguages = $footerSetting?->languages()->orderBy('order')->get() ?? collect();
@endphp

<footer class="footer footer-center p-10 bg-base-200 text-base-content">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="font-bold text-lg mb-4">About</h3>
                @if($footerSetting?->about_text)
                    <div class="prose prose-sm max-w-none">
                        @include('components.rich-text', ['content' => $footerSetting->about_text])
                    </div>
                @endif
            </div>
            <div>
                <h3 class="font-bold text-lg mb-4">Quick Links</h3>
                <ul class="menu menu-vertical">
                    @foreach($footerLinks as $link)
                        <li><a href="{{ $link->link }}">{{ $link->label }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h3 class="font-bold text-lg mb-4">Contact</h3>
                @if($footerSetting?->contact_email)
                    <p class="mb-2">
                        <a href="mailto:{{ $footerSetting->contact_email }}" class="link link-hover">
                            {{ $footerSetting->contact_email }}
                        </a>
                    </p>
                @endif
                @if($footerSetting?->contact_phone)
                    <p class="mb-2">{{ $footerSetting->contact_phone }}</p>
                @endif
                @if($footerSetting?->contact_address)
                    <p class="mb-2 text-sm">{{ $footerSetting->contact_address }}</p>
                @endif
                @if($footerSetting?->donate_link)
                    <a href="{{ $footerSetting->donate_link }}" class="btn btn-primary btn-sm mt-4">Donate</a>
                @endif
            </div>
        </div>
        @if($footerLanguages->isNotEmpty())
            <div class="mt-8">
                <h3 class="font-bold text-lg mb-4">Supported Languages</h3>
                <div class="flex flex-wrap gap-2 justify-center">
                    @foreach($footerLanguages as $lang)
                        <span class="badge badge-outline">{{ $lang->language }}</span>
                    @endforeach
                </div>
            </div>
        @endif
        <div class="mt-8 border-t pt-4">
            @php
                $headerSetting = \App\Models\HeaderSetting::first();
            @endphp
            <p class="text-sm">© {{ date('Y') }} {{ $headerSetting?->site_title ?? 'Mehere Hussain' }}. All rights reserved.</p>
        </div>
    </div>
</footer>

