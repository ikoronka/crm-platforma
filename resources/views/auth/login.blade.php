{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@section('title','Login')

@section('content')
<div class="min-h-screen flex items-center justify-center">
    <form method="POST" action="{{ route('login') }}"
          class="card w-full max-w-sm bg-base-100 shadow-lg p-6 space-y-4">
        @csrf
        <h2 class="text-2xl font-bold text-center">Přihlášení</h2>

        <input name="email" type="email" placeholder="E-mail"
               class="input input-bordered w-full" required autofocus>
        <input name="password" type="password" placeholder="Heslo"
               class="input input-bordered w-full" required>

        <button class="btn btn-primary w-full">Přihlásit se</button>
    </form>
</div>
@endsection
