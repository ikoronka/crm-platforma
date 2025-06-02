@extends('layouts.app')

@section('title', 'Student Register')

@section('content')
<div class="min-h-screen flex items-center justify-center">
   <form method="POST" action="{{ route('student.register') }}"
         class="card w-full max-w-sm bg-base-100 shadow-xl p-6 space-y-4">
        @csrf

        <h2 class="text-2xl font-bold text-center text-white">Student sign-up</h2>

        {{-- Name --}}
        <input name="name" type="text" placeholder="Full name"
               class="input input-bordered w-full text-white" required>

        {{-- Email --}}
        <input name="email" type="email" placeholder="E-mail"
               class="input input-bordered w-full text-white" required>
       
        <input name="birth_year" type="number" min="1900" max="{{ date('Y') }}"
           class="input input-bordered w-full text-white"
           value="{{ old('birth_year') }}" required>
           
        {{-- Password --}}
        <input name="password" type="password" placeholder="Password"
               class="input input-bordered w-full text-white" required>

        {{-- Confirm password --}}
        <input name="password_confirmation" type="password" placeholder="Confirm password"
               class="input input-bordered w-full text-white" required>

        <button class="btn btn-secondary w-full">Sign up</button>

        <p class="text-center text-sm opacity-60">
            Already have an account?
            <a href="{{ route('student.login.show') }}" class="link">Log in</a>
        </p>
   </form>
</div>
@endsection
