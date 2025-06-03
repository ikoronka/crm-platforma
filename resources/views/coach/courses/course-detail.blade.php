{{-- resources/views/coach/course-detail.blade.php --}}
@extends('layouts.coach')
@php($sidebarActive = 'dashboard')

@section('title', 'Course Detail')

@section('coach-content')
    <div class="space-y-8">

        {{-- Název kurzu a tlačítko zpět --}}
        <div class="flex justify-between items-center">
            <h1 class="text-4xl font-bold">{{ $course->name }}</h1>
            <a href="{{ route('coach.dashboard') }}" class="btn btn-sm btn-outline">
                ← Back to Dashboard
            </a>
        </div>

        {{-- Popis kurzu --}}
        <section class="bg-base-100 p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-2">Description</h2>
            @if(trim($course->description))
                <p class="text-sm leading-relaxed text-white whitespace-pre-line">
                    {{ $course->description }}
                </p>
            @else
                <p class="text-sm opacity-60">No description provided.</p>
            @endif
        </section>

        {{-- Sekce: Lekce --}}
        <section>
            <h2 class="text-2xl font-semibold mb-4">Lessons</h2>

            @if($course->lessons->isEmpty())
                <p class="text-sm opacity-60 text-white">No lessons created yet.</p>
            @else
                <div class="space-y-4">
                    @foreach($course->lessons as $lesson)
                        <div class="card bg-base-100 border shadow-sm">
                            <div class="card-body flex justify-between items-center">
                                <div>
                                    <h3 class="card-title">{{ $lesson->title }}</h3>
                                    <p class="text-xs opacity-60">
                                        Scheduled: {{ $lesson->scheduled_at?->format('j.n.Y') ?? 'TBA' }}
                                    </p>
                                </div>
                                <a href="{{ route('coach.lessons.show', $lesson) }}" class="btn btn-sm btn-outline">
                                    View
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        {{-- Sekce: Enrolled Students --}}
        <section>
            <h2 class="text-2xl font-semibold mb-4">Enrolled Students</h2>

            @if($course->students->isEmpty())
                <p class="text-sm opacity-60 text-white">No students enrolled.</p>
            @else
                <div class="overflow-x-auto bg-base-100 rounded-lg shadow-md">
                    <table class="table w-full text-white">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Enrolled at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($course->students as $index => $student)
                                <tr>
                                    <th>{{ $index + 1 }}</th>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td class="text-xs opacity-60">
                                        {{ $student->pivot->created_at?->format('j.n.Y H:i') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

        {{-- Tlačítko pro úpravu kurzu --}}
        <section>
            <a href="{{ route('coach.courses.edit', $course) }}" class="btn btn-primary">
                Edit Course
            </a>
        </section>

    </div>
@endsection
