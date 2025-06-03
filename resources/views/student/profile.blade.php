@extends('layouts.student')
@php($sidebarActive = 'profile')

@section('title', 'Profile Settings')

@section('student-content')
    <h1 class="text-3xl font-bold mb-8">Profile Settings</h1>

    {{-- FLASH bannery už máš v layouts.app (success / error) --}}

    <form method="POST" action="{{ route('student.profile.update') }}" class="space-y-6 max-w-lg text-white">
        @csrf
        @method('PUT')

        {{-- Name --}}
        <label class="form-control">
            <span class="label-text">Name</span>
            <input name="name" type="text" value="{{ old('name', $student->name) }}"
                   class="input input-bordered w-full" required>
            @error('name') <span class="text-error text-sm">{{ $message }}</span> @enderror
        </label>

        {{-- Email --}}
        <label class="form-control">
            <span class="label-text">E-mail</span>
            <input name="email" type="email" value="{{ old('email', $student->email) }}"
                   class="input input-bordered w-full" required>
            @error('email') <span class="text-error text-sm">{{ $message }}</span> @enderror
        </label>

        {{-- Birth year --}}
        <label class="form-control">
            <span class="label-text">Birth year</span>
            <input name="birth_year" type="number" min="1900" max="{{ date('Y') }}"
                   value="{{ old('birth_year', $student->birth_year) }}"
                   class="input input-bordered w-full" required>
            @error('birth_year') <span class="text-error text-sm">{{ $message }}</span> @enderror
        </label>

        <details class="collapse collapse-arrow bg-base-200">
            <summary class="collapse-title text-md font-medium">
                Change password
            </summary>
            <div class="collapse-content space-y-4">

                <label class="form-control">
                    <span class="label-text">New password</span>
                    <input name="password" type="password"
                           class="input input-bordered w-full text-gray-900">
                </label>

                <label class="form-control">
                    <span class="label-text">Confirm password</span>
                    <input name="password_confirmation" type="password"
                           class="input input-bordered w-full text-gray-900">
                </label>

                @error('password')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>
        </details>

        <button class="btn btn-primary">Save changes</button>
    </form>
@endsection
