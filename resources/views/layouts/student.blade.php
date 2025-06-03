@extends('layouts.app')

@section('content')
<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-56 shrink-0 bg-base-200 border-r text-white">
        {{-- $sidebarActive předá každá stránka --}}
        @include('partials.sidebar', ['active' => $sidebarActive ?? ''])
    </aside>

    {{-- HLAVNÍ OBLAST --}}
    <section class="flex-1 p-10 space-y-6">
        @yield('student-content')
    </section>

</div>
@endsection
