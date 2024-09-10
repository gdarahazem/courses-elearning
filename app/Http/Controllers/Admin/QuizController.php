<?php

namespace App\Http\Controllers\Admin;
use App\Course;
use App\Http\Controllers\Controller;
use App\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {

        $quizzes = Quiz::with('course')->get();

        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create()
    {

        $courses = Course::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.quizzes.create', compact('courses'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|exists:courses,id', // Ensure course_id exists in the courses table
        ]);

        // Create a new quiz
        Quiz::create($request->all());

        // Redirect to the list of quizzes
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz created successfully.');
    }
    public function edit(Quiz $quiz)
    {

        $courses = Course::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.quizzes.edit', compact('quiz', 'courses'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        // Validate the incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Update the quiz
        $quiz->update($request->all());

        // Redirect to the list of quizzes
        return redirect()->route('admin.quizzes.index')->with('success', 'Quiz updated successfully.');
    }

    public function destroy(Quiz $quiz)
    {

        $quiz->delete();

        return back();
    }
}
