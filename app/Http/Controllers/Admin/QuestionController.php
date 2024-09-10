<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Question;
use App\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index()
    {

        $questions = Question::with('quiz')->get();

        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {

        $quizzes = Quiz::all()->pluck('title', 'id');

        return view('admin.questions.create', compact('quizzes'));
    }

    public function store(Request $request)
    {

        $question = Question::create($request->all());

        return redirect()->route('admin.questions.index');
    }

    public function edit(Question $question)
    {

        $quizzes = Quiz::all()->pluck('title', 'id');

        return view('admin.questions.edit', compact('question', 'quizzes'));
    }

    public function update(Request $request, Question $question)
    {

        $question->update($request->all());

        return redirect()->route('admin.questions.index');
    }

    public function show(Question $question)
    {

        $question->load('quiz');

        return view('admin.questions.show', compact('question'));
    }

    public function destroy(Question $question)
    {

        $question->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        Question::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
