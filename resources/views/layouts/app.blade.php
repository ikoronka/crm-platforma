<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Moje Appka')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-gray-50">

    {{-- FLASH BANNERY --}}
    @if (session('success'))
        <div id="flash-banner" class="alert alert-success shadow-lg fixed top-4 inset-x-4 md:inset-x-1/3 z-50">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div id="flash-banner" class="alert alert-error shadow-lg fixed top-4 inset-x-4 md:inset-x-1/3 z-50">
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- ZDE INCLUDUJEME NAVBAR Z partials/navbar.blade.php --}}
    @include('partials.navbar')

    {{-- HLAVNÍ OBLAST (z jiných layoutů dědí obsah) --}}
    <div class="pt-4"> {{-- lehký odsazení pod navbar --}}
        @yield('content')
    </div>

    {{-- Skript pro automatické odstranění flash-banneru po 3 sekundách --}}
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const banner = document.getElementById('flash-banner');
            if (!banner) return;
            setTimeout(() => {
                banner.remove();
            }, 3000);
        });
    </script>
</body>
</html>
