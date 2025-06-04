@if(Route::has('student.login.google'))
    <a href="{{ route('student.login.google') }}" class="btn btn-outline-danger w-100 mt-2">
        <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google" style="width:20px; margin-right:8px;"> Continue with Google
    </a>
@endif
