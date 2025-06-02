@extends('layouts.app')

@section('title', 'Student Login')

@section('content')
<div class="min-h-screen flex items-center justify-center">
   <form method="POST" action="{{ route('student.login') }}"
         class="card w-full max-w-sm bg-base-100 shadow-xl p-6 space-y-4">
        @csrf
        <h2 class="text-2xl font-bold text-center text-white">Student login</h2>

        <input name="email" type="email" placeholder="E-mail"
               class="input input-bordered w-full text-white" required autofocus>
        <input name="password" type="password" placeholder="Password"
               class="input input-bordered w-full text-white" required>

        <label class="label cursor-pointer justify-start gap-2">
            <input type="checkbox" name="remember" class="checkbox checkbox-sm">
            <span class="label-text">Remember me</span>
        </label>

        <button class="btn btn-secondary w-full">Log in</button>

        <p class="text-center text-sm opacity-60">
            Coach? <a href="{{ route('coach.login.show') }}" class="link">Login here</a>
        </p>
   </form>
</div>
@endsection
