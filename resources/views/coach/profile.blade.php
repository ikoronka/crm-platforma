{{-- resources/views/coach/profile.blade.php --}}
@extends('layouts.coach')
@php($sidebarActive = 'profile')

@section('title', 'Coach Profile')

@section('coach-content')
    <h1 class="text-3xl font-bold mb-8">Profile Settings (Coach)</h1>

    <form method="POST" action="{{ route('coach.profile.update') }}" class="space-y-6 max-w-lg">
        @csrf
        @method('PUT')

        {{-- Profile picture preview --}}
        <img src="{{ $coach->profile_picture }}" alt="Profile picture"
             class="w-32 h-32 rounded-full object-cover mx-auto">

        {{-- Name --}}
        <label class="form-control">
            <span class="label-text">Name</span>
            <input name="name" type="text"
                   value="{{ old('name', $coach->name ?? '') }}"
                   class="text-white input input-bordered w-full text-gray-900" required>
            @error('name') <span class="text-error text-sm">{{ $message }}</span> @enderror
        </label>

        {{-- Email --}}
        <label class="form-control">
            <span class="label-text">E-mail</span>
            <input name="email" type="email"
                   value="{{ old('email', $coach->email ?? '') }}"
                   class="text-white input input-bordered w-full text-gray-900" required>
            @error('email') <span class="text-error text-sm">{{ $message }}</span> @enderror
        </label>

        {{-- Profile picture URL --}}
        <label class="form-control">
            <span class="label-text">Profile picture URL</span>
            <input name="profile_picture" type="url"
                   value="{{ old('profile_picture', $coach->profile_picture ?? '') }}"
                   class="text-white input input-bordered w-full text-gray-900">
            @error('profile_picture') <span class="text-error text-sm">{{ $message }}</span> @enderror
        </label>

        {{-- Change password --}}
        <details class="collapse collapse-arrow bg-base-200">
            <summary class="collapse-title text-md font-medium">Change password</summary>
            <div class="collapse-content space-y-4">
                <label class="form-control">
                    <span class="label-text">New password</span>
                    <input name="password" type="password" class="text-white input input-bordered w-full text-gray-900">
                </label>
                <label class="form-control">
                    <span class="label-text">Confirm password</span>
                    <input name="password_confirmation" type="password" class="text-white input input-bordered w-full text-gray-900">
                </label>
                @error('password')
                    <span class="text-error text-sm">{{ $message }}</span>
                @enderror
            </div>
        </details>

        <button class="btn btn-primary">Save changes</button>
    </form>
@endsection
