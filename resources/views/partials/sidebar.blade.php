@php($active = $active ?? '')
<div class="list-group list-group-flush p-3">
    <a href="{{ route('student.dashboard') }}"
       class="list-group-item list-group-item-action {{ $active === 'dashboard' ? 'active' : '' }}">
        My courses
    </a>
    <a href="{{ route('student.open') }}"
       class="list-group-item list-group-item-action {{ $active === 'open' ? 'active' : '' }}">
        Open courses
    </a>
    <a href="{{ route('student.profile') }}"
       class="list-group-item list-group-item-action">
        Profile Settings
    </a>
</div>
