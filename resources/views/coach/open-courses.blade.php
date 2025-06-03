{{-- resources/views/coach/open-courses.blade.php --}}
@extends('layouts.coach')
@php($sidebarActive = 'open')

@section('title', 'Open Courses (Coach)')

@section('coach-content')
    <h1 class="text-3xl font-bold mb-8 text-white">Open courses (Coach view)</h1>

    @forelse($courses ?? [] as $course)
        <div class="card bg-base-100 border shadow-sm">
            <div class="card-body space-y-2">
                <h2 class="card-title">{{ $course->name }}</h2>
                <p class="text-sm leading-relaxed">{{ Str::limit($course->description, 200) }}</p>
                <div class="flex justify-between items-center">
                    <span class="text-xs opacity-60">
                        lessons: {{ $course->lessons_count ?? 'n/a' }}
                    </span>
                    <form method="POST" action="#"> {{-- sem později přijde akce --}}
                        @csrf
                        <button class="btn btn-sm btn-primary">
                            Manage
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p class="opacity-60">Žádné otevřené kurzy pro kouče.</p>
    @endforelse
@endsection
