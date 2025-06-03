@extends('layouts.student')
@php($sidebarActive = 'open')

@section('title', 'Open Courses')

@section('student-content')
    <h1 class="text-3xl font-bold mb-8">Open courses</h1>

    @forelse($courses as $course)
        {{-- … karta kurzu + tlačítko Enroll … --}}
    @empty
        <p class="opacity-60">Momentálně nejsou žádné otevřené kurzy.</p>
    @endforelse
@endsection
