<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Moje Appka')</title>
    <!-- this must be in your <head> -->
@vite(['resources/css/app.css','resources/js/app.js'])

</head>
<body class="bg-gray-50 text-gray-900">
    @include('partials.navbar') {{-- volitelný --}}
    
    <main class="min-h-screen">
        @yield('content')
    </main>

    @include('partials.footer') {{-- volitelný --}}
    @stack('scripts')
</body>
</html>
