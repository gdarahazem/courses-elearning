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
        $course->load('institution', 'quizzes'); // Load quizzes related to the course
        $breadcrumb = $course->name;

        $enrollmentStatus = null; // Initialize the status as null
        $bookUrl = null;
        $hasQuiz = false; // Initialize as false
        $latestSubmission = null; // To store the latest submission

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

                // Check if the course has a quiz
                if ($course->quizzes()->exists()) {
                    $hasQuiz = true; // Set to true if there's a quiz for the course

                    // Check if the user has any submissions for the quiz
                    $latestSubmission = auth()->user()->submissions()
                        ->where('quiz_id', $course->quizzes()->first()->id) // Assuming one quiz per course
                        ->latest() // Get the latest submission
                        ->first();
                }
            }
        }

        return view('courses.show', compact('course', 'breadcrumb', 'bookUrl', 'enrollmentStatus', 'hasQuiz', 'latestSubmission'));
    }
}
