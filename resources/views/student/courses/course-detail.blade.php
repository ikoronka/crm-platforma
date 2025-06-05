@extends('layouts.student')
@php($sidebarActive = 'courses')

@section('title', $course->title)

@section('student-content')
<div class="container my-4">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h2 class="h5 mb-0">{{ $course->title }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Description:</strong></p>
            <p>{{ $course->description ?? 'No description provided.' }}</p>
        </div>
        @if($course->lessons && $course->lessons->count())
        <div class="card-footer">
            <h5>Lessons</h5>
            <ul class="list-group">
                @foreach($course->lessons as $lesson)
                <li class="list-group-item">
                    <a href="">
                        {{ $lesson->title }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card-footer text-end">
            <a href="{{ route('student.dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>
</div>
@endsection
