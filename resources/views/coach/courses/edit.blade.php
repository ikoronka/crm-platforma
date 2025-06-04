{{-- resources/views/coach/courses/edit.blade.php --}}
@extends('layouts.coach')

@php($sidebarActive = 'dashboard') {{-- nebo 'courses' pokud máte jinou logiku sidebaru --}}

@section('title', 'Edit Course')

@section('coach-content')
    <div class="max-w-2xl mx-auto p-6 space-y-6">
        <h1 class="text-3xl font-bold text-white">Edit Course: {{ $course->name }}</h1>

        <form action="{{ route('coach.courses.update', $course) }}" 
              method="POST" 
              class="space-y-4 bg-base-100 p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            {{-- Název kurzu --}}
            <label class="block">
                <span class="text-white font-medium">Course Name</span>
                <input 
                    type="text" 
                    name="name" 
                    value="{{ old('name', $course->name) }}" 
                    class="input input-bordered w-full mt-1" 
                    required>
                @error('name')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </label>

            {{-- Šablona kurzu (template_id) – zatím necháme prázdné, pokud nechceme používat --}}
            <label class="block">
                <span class="text-white font-medium">Template ID (optional)</span>
                <input 
                    type="number" 
                    name="template_id" 
                    value="{{ old('template_id', $course->template_id) }}" 
                    class="input input-bordered w-full mt-1">
                @error('template_id')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </label>

            {{-- Začátek a konec kurzu --}}
            <div class="grid grid-cols-2 gap-4">
                <label class="block">
                    <span class="text-white font-medium">Start Date</span>
                    <input 
                        type="date" 
                        name="start_date" 
                        value="{{ old('start_date', $course->start_date?->format('Y-m-d')) }}" 
                        class="input input-bordered w-full mt-1">
                    @error('start_date')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </label>
                <label class="block">
                    <span class="text-white font-medium">End Date</span>
                    <input 
                        type="date" 
                        name="end_date" 
                        value="{{ old('end_date', $course->end_date?->format('Y-m-d')) }}" 
                        class="input input-bordered w-full mt-1">
                    @error('end_date')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </label>
            </div>

            {{-- Schedule Info --}}
            <label class="block">
                <span class="text-white font-medium">Schedule Info (optional)</span>
                <input 
                    type="text" 
                    name="schedule_info" 
                    value="{{ old('schedule_info', $course->schedule_info) }}" 
                    placeholder="Např. „Pondělí a středa 15:00–17:00“"
                    class="input input-bordered w-full mt-1">
                @error('schedule_info')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </label>

            <div class="mt-6 flex justify-between items-center">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('coach.courses.manage', $course) }}" class="link text-white">Cancel</a>
            </div>
        </form>

        <form method="POST" action="{{ route('coach.courses.destroy', $course) }}" class="mt-4" onsubmit="return confirm('Delete this course?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-error">Delete Course</button>
        </form>
    </div>
@endsection
