{{-- resources/views/layouts/coach.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="flex min-h-screen">

    {{-- LEVÝ SLUPEC – sidebar‐coach --}}
    <aside class="w-56 shrink-0 bg-base-200 border-r">
        @include('partials.sidebar-coach', ['active' => $sidebarActive ?? 'dashboard'])
    </aside>

    {{-- Hlavní oblast pro coach‐obsah --}}
    <section class="flex-1 p-10 space-y-6">
        @yield('coach-content')
    </section>

</div>
@endsection
