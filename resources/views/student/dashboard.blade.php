@extends('layouts.student')
@php($sidebarActive = 'dashboard')

@section('title', 'Student Dashboard')

@section('student-content')
    <h1 class="text-3xl font-bold mb-8">Courses you are enrolled in:</h1>

    @forelse($courses as $course)
        {{-- … karta kurzu (beze změny) … --}}
    @empty
        <p class="opacity-60">You are not enrolled in any course yet.</p>
    @endforelse
@endsection
