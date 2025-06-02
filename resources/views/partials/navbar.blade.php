<nav class="navbar bg-base-100 shadow-md px-4">
    {{-- logo --}}
    <div class="navbar-start">
        <a href="{{ url('/') }}" class="btn btn-ghost text-xl normal-case text-white">logo</a>
    </div>

    {{-- odkazy pro hosta --}}
    @guest('coach')
        @guest('student')
            <div class="navbar-end gap-2">
                <a href="{{ route('student.login.show') }}" class="btn btn-sm btn-outline">Login as Student</a>
                <a href="{{ route('coach.login.show') }}"   class="btn btn-sm btn-primary">Login as Coach</a>
            </div>
        @endguest
    @endguest

    {{-- po přihlášení kouče / studenta můžeš přidat jiné menu --}}
</nav>
