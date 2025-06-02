<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Moje Appka')</title>

    {{-- Vite CSS/JS --}}
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900">

    {{-- NAVBAR --}}
    @include('partials.navbar')

    {{-- FLASH BANNERS ------------------------------------------------ --}}
    @if (session('success'))
        <div class="alert alert-success fixed top-4 inset-x-4 md:inset-x-1/3 z-50 shadow-lg">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-error fixed top-4 inset-x-4 md:inset-x-1/3 z-50 shadow-lg">
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- banner pro první validační chybu --}}
    @if ($errors->any())
        <div class="alert alert-error fixed top-4 inset-x-4 md:inset-x-1/3 z-50 shadow-lg">
            <span>{{ $errors->first() }}</span>
        </div>
    @endif


    {{-- OBSAH STRÁNKY --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- FOOTER (volitelně) --}}
    @include('partials.footer')

    {{-- Dodatečné skripty --}}
    @stack('scripts')
</body>
</html>
