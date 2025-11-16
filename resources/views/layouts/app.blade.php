<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Mehere Hussain')</title>
    <meta name="description" content="@yield('description', 'The Hadith of the Prophet Muhammad (صلى الله عليه و سلم) at your fingertips')">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Mehere Hussain')">
    <meta property="og:description" content="@yield('description', 'The Hadith of theProphet Muhammad (صلى الله عليه و سلم) at your fingertips')">
    <meta property="og:image" content="@yield('og_image', asset('favicon.svg'))">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'Mehere Hussain')">
    <meta property="twitter:description" content="@yield('description', 'The Hadith of the Prophet Muhammad (صلى الله عليه و سلم) at your fingertips')">
    <meta property="twitter:image" content="@yield('og_image', asset('favicon.svg'))">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;500;600;700&family=Noto+Nastaliq+Urdu:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Structured Data -->
    @include('components.structured-data')
</head>
<body class="min-h-screen bg-base-100">
    <div class="flex flex-col min-h-screen">
        @include('components.header')

        <main class="flex-grow">
            @yield('content')
        </main>

        @include('components.footer')
    </div>

    @stack('scripts')
</body>
</html>

