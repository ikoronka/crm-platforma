<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Moje Appka')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ENjdO4Dr2bkBIFxQpeoA6DQD02K4eAt+Uaz2bR0I3zE+nqU9cE+M9KfG5D1pb1d" crossorigin="anonymous">
    {{-- Bootstrap CDN only, no build step needed --}}
</head>
<body>

    {{-- FLASH BANNERY --}}
    @if (session('success'))
        <div id="flash-banner" class="alert alert-success position-fixed top-0 start-50 translate-middle-x mt-3 shadow">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div id="flash-banner" class="alert alert-danger position-fixed top-0 start-50 translate-middle-x mt-3 shadow">
            <span>{{ session('error') }}</span>
        </div>
    @endif

    {{-- ZDE INCLUDUJEME NAVBAR Z partials/navbar.blade.php --}}
    @include('partials.navbar')

    {{-- HLAVNÍ OBLAST (z jiných layoutů dědí obsah) --}}
    <div class="pt-4 container"> {{-- lehký odsazení pod navbar --}}
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-q/QDYob/oKhY7HF8S9BDrGFhkaN/hfbc8w3k2G6pJUp5I1cDIeEJDfBqXc9E+IOk" crossorigin="anonymous"></script>
    {{-- Skript pro flash banner a inicializaci carouselu --}}
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const banner = document.getElementById('flash-banner');
            if (banner) {
                setTimeout(() => banner.remove(), 3000);
            }

            document.querySelectorAll('.carousel').forEach(el => {
                new bootstrap.Carousel(el);
            });
        });
    </script>
</body>
</html>
