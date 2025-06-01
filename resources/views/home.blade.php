@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<section class="min-h-screen flex flex-col lg:flex-row items-center justify-center lg:justify-between px-6 lg:px-16">
    {{-- LEVÁ STRANA – text --}}
    <div class="max-w-lg space-y-6 lg:mr-12 text-center lg:text-left">
        <h1 class="text-5xl font-bold">Welcome</h1>
        <p class="text-lg opacity-80">
            Manage courses, lessons &amp; homework in one simple place.
        </p>

        <div class="space-x-2">
            <a href="" class="btn btn-primary">Začít zdarma</a>
            <a href=""    class="btn btn-outline">Přihlásit se</a>
        </div>
    </div>

    {{-- PRAVÁ STRANA – carousel --}}
    <div class="w-full lg:w-[600px] xl:w-[720px] mt-10 lg:mt-0">
        <div id="landingCarousel" class="carousel rounded-box w-full scroll-smooth">
            @for ($i = 1; $i <= 3; $i++)
                <div id="slide{{ $i }}" class="carousel-item relative w-full landing-slide">
                    <img src="{{ asset("images/landing-$i.jpg") }}"
                         class="w-full h-64 md:h-80 xl:h-[480px] object-cover" />
                    <a href="#slide{{ $i === 1 ? 3 : $i - 1 }}"
                       class="btn btn-circle btn-xs absolute left-2 top-1/2 -translate-y-1/2">❮</a>
                    <a href="#slide{{ $i === 3 ? 1 : $i + 1 }}"
                       class="btn btn-circle btn-xs absolute right-2 top-1/2 -translate-y-1/2">❯</a>
                </div>
            @endfor
        </div>
    </div>
</section>

{{-- Auto-scroll script --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const slides  = document.querySelectorAll('.landing-slide');
    let index = 0;
    setInterval(() => {
        index = (index + 1) % slides.length;
        slides[index].scrollIntoView({behavior: 'smooth', inline: 'start', block: 'nearest'});
    }, 5000);             // 5 s interval
});
</script>
@endpush
@endsection
