<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CoachCourseController extends Controller
{
    /**
     * Dashboard – vypíše kurzy, které kouč vyučuje.
     */
    public function myCourses(Request $request)
    {
        $coach = $request->user('coach');

        // Načteme všechny kurzy patřící přihlášenému kouči
        $courses = $coach->courses()->get();

        return view('coach.dashboard', compact('courses'));
    }

    /**
     * Open courses – (pokud by bylo potřeba) kurzy, které kouč už ještě nevyučuje.
     */
    public function openCourses(Request $request)
    {
        $coach = $request->user('coach');

        // Příklad (předpokládá pivotovou tabulku nebo sloupec coach_id):
        // $assignedIds = $coach->courses()->pluck('courses.id');
        // $courses = Course::whereNotIn('id', $assignedIds)->get();

        $courses = collect(); // prozatím prázdná kolekce

        return view('coach.open-courses', compact('courses'));
    }

    /**
     * Manage (detail) – zobrazí detail konkrétního kurzu pro kouče.
     */
    public function manage(Course $course)
    {
        // Eager‐load lessons a students, pokud máte vztahy nastavené v modelu
        $course->load(['lessons', 'students']);

        return view('coach.course-detail', compact('course'));
    }
}
