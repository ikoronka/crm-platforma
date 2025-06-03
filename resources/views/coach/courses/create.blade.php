{{-- resources/views/coach/courses/create.blade.php --}}
@extends('layouts.coach')
@php($sidebarActive = 'dashboard')

@section('title', 'Create New Course')

@section('coach-content')
    <div class="max-w-3xl mx-auto space-y-6">
        <h1 class="text-3xl font-bold text-white">Create Course</h1>

        <form action="{{ route('coach.courses.store') }}" method="POST" class="space-y-4 bg-base-100 p-6 rounded-lg shadow-lg">
            @csrf

            <div>
                <label class="block text-sm font-medium text-white mb-1" for="name">Course Name</label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    value="{{ old('name') }}"
                    class="input input-bordered w-full bg-base-200 text-white"
                    required
                >
                @error('name')
                    <p class="text-xs text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-white mb-1" for="description">Description</label>
                <textarea
                    name="description"
                    id="description"
                    rows="4"
                    class="textarea textarea-bordered w-full bg-base-200 text-white"
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-xs text-error mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-white mb-1" for="start_date">Start Date</label>
                    <input
                        type="date"
                        name="start_date"
                        id="start_date"
                        value="{{ old('start_date') }}"
                        class="input input-bordered w-full bg-base-200 text-white"
                    >
                    @error('start_date')
                        <p class="text-xs text-error mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-white mb-1" for="end_date">End Date</label>
                    <input
                        type="date"
                        name="end_date"
                        id="end_date"
                        value="{{ old('end_date') }}"
                        class="input input-bordered w-full bg-base-200 text-white"
                    >
                    @error('end_date')
                        <p class="text-xs text-error mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-full">Create course</button>
        </form>
    </div>
@endsection
