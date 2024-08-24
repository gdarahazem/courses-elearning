<?php

namespace App\Http\Controllers;

use App\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::searchResults()
            ->paginate(6);

        $breadcrumb = "Courses";

        return view('courses.index', compact(['courses', 'breadcrumb']));
    }

    public function show(Course $course)
    {
        $course->load('institution');
        $breadcrumb = $course->name;

        $enrollmentStatus = null; // Initialize the status as null
        $bookUrl = null;

        if (auth()->check()) {
            $enrollment = auth()->user()->enrollments()
                ->where('course_id', $course->id)
                ->first(); // Fetch the enrollment object

            if ($enrollment) {
                $enrollmentStatus = $enrollment->status; // Get the status of the enrollment
                if ($enrollmentStatus === 'accepted') {
                    $bookMedia = $course->getFirstMedia('books');
                    $bookUrl = $bookMedia ? $bookMedia->getUrl() : null;
                }
            }
        }

        return view('courses.show', compact('course', 'breadcrumb', 'bookUrl', 'enrollmentStatus'));
    }
}
