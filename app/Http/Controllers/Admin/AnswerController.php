<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;


class AnswerController extends Controller
{
    public function index()
    {

        $answers = Answer::with('question')->get();

        return view('admin.answers.index', compact('answers'));
    }

    public function create()
    {

        $questions = Question::all()->pluck('question_text', 'id');

        return view('admin.answers.create', compact('questions'));
    }

    public function store(Request $request)
    {

        Answer::create($request->all());

        return redirect()->route('admin.answers.index');
    }

    public function edit(Answer $answer)
    {

        $questions = Question::all()->pluck('question_text', 'id');

        return view('admin.answers.edit', compact('answer', 'questions'));
    }

    public function update(Request $request, Answer $answer)
    {

        $answer->update($request->all());

        return redirect()->route('admin.answers.index');
    }

    public function show(Answer $answer)
    {

        $answer->load('question');

        return view('admin.answers.show', compact('answer'));
    }

    public function destroy(Answer $answer)
    {

        $answer->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        Answer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
