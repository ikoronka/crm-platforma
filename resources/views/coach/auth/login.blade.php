@extends('layouts.app')

@section('title', 'Coach Login')

@section('content')
<div class="min-h-screen flex items-center justify-center">
   <form method="POST" action="{{ route('coach.login') }}"
         class="card w-full max-w-sm bg-base-100 shadow-xl p-6 space-y-4">
        @csrf
        <h2 class="text-2xl font-bold text-center">Coach login</h2>

        <input name="email" type="email" placeholder="E-mail"
               class="input input-bordered w-full" required autofocus>
        <input name="password" type="password" placeholder="Password"
               class="input input-bordered w-full" required>

        <label class="label cursor-pointer justify-start gap-2">
            <input type="checkbox" name="remember" class="checkbox checkbox-sm">
            <span class="label-text">Remember me</span>
        </label>

        <button class="btn btn-primary w-full">Log in</button>

        <p class="text-center text-sm opacity-60">
            Student? <a href="{{ route('student.login.show') }}" class="link">Login here</a>
        </p>
   </form>
</div>
@endsection
