<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\SubmissionAnswer;
use Illuminate\Http\Request;

class SubmissionAnswerController extends Controller
{
    public function index()
    {
        return SubmissionAnswer::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([

        ]);

        return SubmissionAnswer::create($data);
    }

    public function show(SubmissionAnswer $submissionAnswer)
    {
        return $submissionAnswer;
    }

    public function update(Request $request, SubmissionAnswer $submissionAnswer)
    {
        $data = $request->validate([

        ]);

        $submissionAnswer->update($data);

        return $submissionAnswer;
    }

    public function destroy(SubmissionAnswer $submissionAnswer)
    {
        $submissionAnswer->delete();

        return response()->json();
    }
}
