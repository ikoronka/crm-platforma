{{-- resources/views/coach/dashboard.blade.php --}}
@extends('layouts.coach')
@php($sidebarActive = 'dashboard')

@section('title', 'Coach Dashboard')

@section('coach-content')
    <h1 class="text-3xl font-bold mb-8 text-white">Courses you are instructing:</h1>

    <div class="space-y-6">
        @forelse($courses as $course)
            <div class="card bg-base-100 border shadow-sm">
                <div class="card-body">
                    {{-- Název + datum další lekce (pokud máš v modelu Course atribut next_session) --}}
                    <div class="flex items-baseline justify-between">
                        <h2 class="card-title">{{ $course->name }}</h2>
                        <p class="text-xs opacity-60">
                            @if(isset($course->next_session))
                                next session: {{ $course->next_session->format('j.n.Y') }}
                            @else
                                next session: TBA
                            @endif
                        </p>
                    </div>

                    {{-- Krátký popis --}}
                    <p class="text-sm leading-relaxed line-clamp-3">
                        {{ Str::limit($course->description, 200) }}
                    </p>

                    <div class="card-actions">
                        <a href="{{ route('coach.courses.manage', $course) }}"
                           class="btn btn-sm btn-outline">
                            Detail
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="opacity-60 text-white">You are not instructing any courses yet.</p>
        @endforelse
    </div>
@endsection
