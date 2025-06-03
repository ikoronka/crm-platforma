<nav class="navbar bg-base-100 shadow-md px-4">

    {{-- LOGO --}}
    <div class="navbar-start">
        <a href="{{ url('/') }}" class="btn btn-ghost text-xl normal-case text-white">logo</a>
    </div>

    {{-- PRAVÁ STRANA --}}
    <div class="navbar-end flex items-center space-x-2">

        {{-- === STUDENT SECTION === --}}
        @auth('student')
            {{-- Pokud je student přihlášen, zobraz odkaz na student dashboard --}}
            <a href="{{ route('student.dashboard') }}" class="btn btn-sm btn-success">
                Dashboard (Student)
            </a>
            {{-- Logout Student --}}
            <form method="POST" action="{{ route('student.logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline btn-error">
                    Logout Student
                </button>
            </form>
        @else
            {{-- Pokud student není přihlášen, zobraz login --}}
            <a href="{{ route('student.login.show') }}" class="btn btn-sm btn-outline">
                Login as Student
            </a>
        @endauth


        {{-- === COACH SECTION === --}}
        @auth('coach')
            {{-- Pokud je kouč přihlášen, zobraz odkaz na coach dashboard --}}
            <a href="{{ route('coach.dashboard') }}" class="btn btn-sm btn-success">
                Dashboard (Coach)
            </a>
            {{-- Logout Coach --}}
            <form method="POST" action="{{ route('coach.logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline btn-error">
                    Logout Coach
                </button>
            </form>
        @else
            {{-- Pokud kouč není přihlášen, zobraz login --}}
            <a href="{{ route('coach.login.show') }}" class="btn btn-sm btn-primary">
                Login as Coach
            </a>
        @endauth

    </div>
</nav>
