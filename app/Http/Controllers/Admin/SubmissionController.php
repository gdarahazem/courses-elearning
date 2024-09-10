<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function index()
    {

        $submissions = Submission::with(['user', 'quiz'])->get();

        return view('admin.submissions.index', compact('submissions'));
    }

    public function show(Submission $submission)
    {

        return view('admin.submissions.show', compact('submission'));
    }

    public function destroy(Submission $submission)
    {

        $submission->delete();

        return back();
    }
}
