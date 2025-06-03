{{-- resources/views/coach/lesson-detail.blade.php --}}
@extends('layouts.coach')
@php($sidebarActive = 'dashboard') {{-- Nebo změňte na 'courses' pokud máte v sidebaru speciální aktivní položku pro lekce --}}

@section('title', 'Lesson Detail')

@section('coach-content')
    <div class="space-y-8">

        {{-- Hlavička: Název lekce + tlačítko „Back“ --}}
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold text-white">{{ $lesson->title }}</h1>
                @if($lesson->scheduled_at)
                    <p class="text-sm opacity-60 text-white">Scheduled: {{ $lesson->scheduled_at->format('j.n.Y H:i') }}</p>
                @endif
            </div>
            <a href="{{ route('coach.courses.manage', $lesson->course) }}"
               class="btn btn-sm btn-outline">
                ← Back to Course
            </a>
        </div>

        {{-- Popis lekce --}}
        <section class="bg-base-100 p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-2 text-white">Lesson Description</h2>
            @if(trim($lesson->description))
                <p class="text-sm leading-relaxed text-white whitespace-pre-line">
                    {{ $lesson->description }}
                </p>
            @else
                <p class="text-sm opacity-60 text-white">No description provided for this lesson.</p>
            @endif
        </section>

        {{-- Zadání domácího úkolu --}}
        @if($lesson->homework)
            <section class="bg-base-100 p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-2 text-white">Homework Assignment</h2>
                <p class="text-sm leading-relaxed text-white whitespace-pre-line">
                    {{ $lesson->homework->instructions }}
                </p>
                @if($lesson->homework->due_date)
                    <p class="text-sm opacity-60 text-white mt-1">
                        Due date: {{ $lesson->homework->due_date->format('j.n.Y') }}
                    </p>
                @endif
            </section>
        @else
            <section class="bg-base-100 p-6 rounded-lg shadow-md">
                <p class="text-sm opacity-60 text-white">No homework assigned for this lesson.</p>
            </section>
        @endif

        {{-- Seznam odevzdaných úkolů studentů --}}
        <section>
            <h2 class="text-2xl font-semibold mb-4 text-white">Student Submissions</h2>

            @if($lesson->submissions->isEmpty())
                <p class="text-sm opacity-60 text-white">No submissions yet.</p>
            @else
                <div class="overflow-x-auto bg-base-100 rounded-lg shadow-md">
                    <table class="table w-full text-white">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Student Name</th>
                                <th>Submitted At</th>
                                <th>File</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lesson->submissions as $index => $submission)
                                <tr>
                                    <th>{{ $index + 1 }}</th>
                                    <td>{{ $submission->student->name }}</td>
                                    <td class="text-xs opacity-60">
                                        {{ $submission->created_at 
                                            ? $submission->created_at->format('j.n.Y H:i') 
                                            : '–' 
                                        }}
                                    </td>

                                    <td>
                                        @if($submission->file_path)
                                            <a href="{{ asset('storage/' . $submission->file_path) }}"
                                               class="link link-primary" target="_blank">
                                                Download
                                            </a>
                                        @else
                                            <span class="opacity-60">No file</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

        {{-- Tlačítko pro úpravu lekce (případně přidání/úpravu homework) --}}
        <section>
            <a href=""
               class="btn btn-primary">
                Edit Lesson
            </a>
        </section>

    </div>
@endsection
