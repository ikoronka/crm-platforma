{{-- resources/views/student/dashboard.blade.php --}}
@extends('layouts.app')

@section('title','Student Dashboard')

@section('content')
<div class="flex min-h-screen">

    {{-- SIDE-BAR --------------------------------------------------}}
    <aside class="w-56 shrink-0 bg-base-200 border-r">
        <div class="flex flex-col gap-2 p-4">
            <x-link-side href="{{ route('student.dashboard') }}" icon="home">
                My courses
            </x-link-side>

            <x-link-side href="{{ route('student.open') }}" icon="book-open">
                Open courses
            </x-link-side>

            <x-link-side href="{{ route('student.profile') }}" icon="user">
                Profile Settings
            </x-link-side>
        </div>
    </aside>

    {{-- MAIN CONTENT --------------------------------------------}}
    <section class="flex-1 p-10 space-y-6">

        <h1 class="text-3xl font-bold mb-8">
            Courses you are enrolled in:
        </h1>

        {{-- COURSE CARDS --}}
        @forelse ($courses as $course)
            <div class="card bg-base-100 border shadow-sm">
                <div class="card-body">

                    {{-- Title + next session --}}
                    <div class="flex items-baseline justify-between">
                        <h2 class="card-title">{{ $course->name }}</h2>
                        <p class="text-xs opacity-60">
                            next session: {{ $course->next_session?->format('j n Y') ?? 'TBA' }}
                        </p>
                    </div>

                    {{-- Short description --}}
                    <p class="text-sm leading-relaxed line-clamp-3">
                        {{ Str::limit($course->description, 300) }}
                    </p>

                    <div class="card-actions">
                        <a href="{{ route('courses.show', $course) }}"
                           class="btn btn-sm btn-outline">Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="opacity-60">You are not enrolled in any course yet.</p>
        @endforelse

    </section>
</div>
@endsection

{{-- reusable sidebar link component ----------------------------------}}
@once
    @push('components')
        <x-dynamic-component name="link-side">
            @props(['href', 'icon'])

            <a href="{{ $href }}"
               {{ $attributes->merge(['class' =>
                    'btn btn-ghost justify-start font-medium w-full']) }}>
                <i class="lucide-{{ $icon }} w-4 h-4 mr-2"></i>
                {{ $slot }}
            </a>
        </x-dynamic-component>
    @endpush
@endonce
