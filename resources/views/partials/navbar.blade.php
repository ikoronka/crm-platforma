<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand">MyCRM</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
                {{-- === STUDENT SECTION === --}}
                @auth('student')
                {{-- Student is logged in --}}
                <li class="nav-item">
                    <a href="{{ secure_url('student.dashboard') }}" class="btn btn-sm btn-light">Dashboard (Student)</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ secure_url('student.logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-light">Logout Student</button>
                    </form>
                </li>
                @else
                {{-- Only show Student Login if no coach is logged in --}}
                @if(!Auth::guard('coach')->check())
                <li class="nav-item">
                    <a href="{{ secure_url('student.login.show') }}" class="btn btn-sm btn-outline-light">Login as Student</a>
                </li>
                <li class="nav-item">
                    <a href="{{ secure_url('student.register.show') }}" class="btn btn-sm btn-outline-light">Make a Student account</a>
                </li>
                @endif
                @endauth

                {{-- === COACH SECTION === --}}
                @auth('coach')
                {{-- Coach is logged in --}}
                <li class="nav-item">
                    <a href="{{ secure_url('coach.dashboard') }}" class="btn btn-sm btn-light">Dashboard (Coach)</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ secure_url('coach.logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-light">Logout Coach</button>
                    </form>
                </li>
                @else
                {{-- Only show Coach Login if no student is logged in --}}
                @if(!Auth::guard('student')->check())
                <li class="nav-item">
                    <a href="{{ secure_url('coach.login.show') }}" class="btn btn-sm btn-outline-light">Login as Coach</a>
                </li>
                @endif
                @endauth

                {{-- === ADMIN SECTION === --}}
                @auth('admin')
                <li class="nav-item">
                    <a href="{{ secure_url('admin.dashboard') }}" class="btn btn-sm btn-light">Dashboard (Admin)</a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ secure_url('admin.logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-light">Logout Admin</button>
                    </form>
                </li>
                @else
                @if(!Auth::guard('coach')->check() && !Auth::guard('student')->check())
                <li class="nav-item">
                    <a href="{{ secure_url('admin.login.show') }}" class="btn btn-sm btn-outline-light">Login as Admin</a>
                </li>
                @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>
