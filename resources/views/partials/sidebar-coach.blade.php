@php($active = $active ?? '')

<div class="flex flex-col gap-2 p-4">

    {{-- Odkaz na koache CSSW Dashboard --}}
    <a href="{{ route('coach.dashboard') }}"
       class="btn btn-ghost justify-start w-full font-medium
              {{ $active === 'dashboard' ? 'btn-active' : '' }}">
        <i class="lucide-home w-4 h-4 mr-2"></i> My courses
    </a>

    {{-- Odkaz na Profile Settings pro koache --}}
    <a href="{{ route('coach.profile') }}"
       class="btn btn-ghost justify-start w-full font-medium
              {{ $active === 'profile' ? 'btn-active' : '' }}">
        <i class="lucide-user w-4 h-4 mr-2"></i> Profile Settings
    </a>

</div>
