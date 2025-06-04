{{-- resources/views/coach/lessons/edit.blade.php --}}
@extends('layouts.coach')
@php($sidebarActive = 'dashboard')

@section('title', 'Edit Lesson')

@section('coach-content')
    <div class="max-w-2xl mx-auto p-6 space-y-6">
        <h1 class="text-3xl font-bold text-white">Edit Lesson: {{ $lesson->title }}</h1>

        <form method="POST" action="{{ route('coach.lessons.update', $lesson) }}" class="space-y-4 bg-base-100 p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')

            <label class="block">
                <span class="text-white font-medium">Title</span>
                <input type="text" name="title" value="{{ old('title', $lesson->title) }}" class="input input-bordered w-full mt-1" required>
                @error('title')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
            </label>

            <label class="block">
                <span class="text-white font-medium">Description</span>
                <textarea name="description" class="textarea textarea-bordered w-full mt-1">{{ old('description', $lesson->description) }}</textarea>
                @error('description')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
            </label>

            <label class="block">
                <span class="text-white font-medium">Scheduled At</span>
                <input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at', $lesson->scheduled_at?->format('Y-m-d\\TH:i')) }}" class="input input-bordered w-full mt-1">
                @error('scheduled_at')<p class="text-red-400 text-sm mt-1">{{ $message }}</p>@enderror
            </label>

            <div class="mt-6 flex justify-between items-center">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a href="{{ route('coach.lessons.show', $lesson) }}" class="link text-white">Cancel</a>
            </div>
        </form>

        <form method="POST" action="{{ route('coach.lessons.destroy', $lesson) }}" onsubmit="return confirm('Delete this lesson?');" class="mt-4">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-error">Delete Lesson</button>
        </form>
    </div>
@endsection

