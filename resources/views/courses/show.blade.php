{{-- resources/views/courses/show.blade.php --}}
@extends('layouts.coach')

@section('content')
    {{-- Hlavní nadpis --}}
    <h1 class="text-3xl font-bold text-white mb-8">{{ $course->name }}</h1>

    <div class="space-y-6">
        {{-- Panel s daty kurzu --}}
        <div class="bg-base-100 p-6 rounded-lg shadow-md">
            {{-- Další termín, Stav registrace, Datum startu a konce --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                <div class="flex items-center mb-2 md:mb-0">
                    @if($nextSession)
                        <span class="badge badge-info mr-4">
                            Další termín: <strong>{{ $nextSession }}</strong>
                        </span>
                    @endif

                    @if($registrationOpen)
                        <span class="badge badge-success">Registrace otevřená</span>
                    @else
                        <span class="badge badge-error">Registrace uzavřená</span>
                    @endif
                </div>

                <div class="text-gray-600">
                    Začátek / konec: <strong>{{ $startDate }} &ndash; {{ $endDate }}</strong>
                </div>
            </div>

            {{-- Popis kurzu --}}
            <div class="prose max-w-none text-gray-800">
                {!! nl2br(e($course->description)) !!}
            </div>
        </div>

        {{-- Seznam studentů --}}
        <div class="bg-base-100 p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Studenti přihlášení do kurzu</h2>

            @if($course->students->isEmpty())
                <div class="text-gray-500">Žádní studenti zatím přihlášeni.</div>
            @else
                <ul class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($course->students as $student)
                        <li class="flex items-center space-x-3 p-4 border border-gray-200 rounded-lg hover:shadow">
                            {{-- Kolečko–ikona místo radio (můžeš to upravit podle potřeby) --}}
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-5 w-5 text-gray-500"
                                 fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <circle cx="12" cy="12" r="10" stroke-width="2"></circle>
                                <circle cx="12" cy="12" r="5" fill="currentColor"></circle>
                            </svg>
                            <span class="font-medium text-gray-700">{{ $student->name }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Akční tlačítka --}}
        <div class="flex flex-wrap gap-4">
            {{-- Spravovat studenty --}}
            <a href="{{ route('courses.students.manage', $course->id) }}"
               class="btn btn-outline btn-sm">
                Spravovat studenty
            </a>

            {{-- Otevřít/Uzavřít registraci --}}
            <form action="{{ route('courses.toggleRegistration', $course->id) }}" method="POST" class="inline-block">
                @csrf
                <button type="submit"
                        class="btn btn-sm {{ $registrationOpen ? 'btn-warning' : 'btn-success' }}">
                    {{ $registrationOpen ? 'Uzavřít registraci' : 'Otevřít registraci' }}
                </button>
            </form>

            {{-- Editovat kurz --}}
            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-primary">
                Editovat kurz
            </a>

            {{-- Smazat kurz --}}
            <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                  onsubmit="return confirm('Opravdu chcete smazat tento kurz?');" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-error">
                    Smazat kurz
                </button>
            </form>

            {{-- Přidat domácí úkol --}}
            <a href="{{ route('homeworks.create', ['course' => $course->id]) }}"
               class="btn btn-sm btn-info">
                Přidat domácí úkol
            </a>

            {{-- Otevřít seznam lekcí --}}
            <a href="{{ route('courses.lessons.index', $course->id) }}" class="btn btn-sm btn-neutral">
                Otevřít seznam lekcí
            </a>
        </div>
    </div>
@endsection
