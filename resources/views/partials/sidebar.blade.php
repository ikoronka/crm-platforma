@php($active = $active ?? '')
<div class="flex flex-col gap-2 p-4">

    <a href="{{ route('student.dashboard') }}"
       class="btn btn-ghost justify-start w-full font-medium
              {{ $active === 'dashboard' ? 'btn-active' : '' }}">
        <i class="lucide-home w-4 h-4 mr-2"></i> My courses
    </a>

    <a href="{{ route('student.open') }}"
       class="btn btn-ghost justify-start w-full font-medium
              {{ $active === 'open' ? 'btn-active' : '' }}">
        <i class="lucide-book-open w-4 h-4 mr-2"></i> Open courses
    </a>

    <a href="{{ route('student.profile') }}"
       class="btn btn-ghost justify-start w-full font-medium">
        <i class="lucide-user w-4 h-4 mr-2"></i> Profile Settings
    </a>
</div>
