<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends Controller
{
    /**
     * Display the student dashboard with their enrolled courses.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get the authenticated student using the correct guard (adjust if necessary)
        $student = auth()->guard('student')->user();

        // Assuming your Student model has a "courses" relationship
        $courses = $student->courses;

        // Return the dashboard view and pass the courses data
        return view('student.dashboard', compact('courses'));
    }

    /**
     * Display the specified course.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\View\View
     */
    public function show(Course $course)
    {
        return view('courses.course-detail', compact('course'));
    }

}
