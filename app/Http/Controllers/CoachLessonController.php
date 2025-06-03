<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;

class CoachLessonController extends Controller
{
    /**
     * Zobrazí detail konkrétní lekce (pro kouče).
     */
    public function show(Lesson $lesson)
    {
        // Eager‐load vztahy, pokud je budete potřebovat (např. domácí úkoly, odevzdané práce)
        $lesson->load([
        'homework',             // pokud existuje vztah Lesson::homework()
        'submissions.student',  // pokud existuje vztah Lesson::submissions() a Submission::student()
    ]);

        return view('coach.lesson-detail', compact('lesson'));
    }
}
