<?php

namespace App\Http\Controllers;

use App\Course;
use App\Mail\QuizResultMail;
use App\Quiz;
use App\Submission;
use App\SubmissionAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class QuizController extends Controller
{
    public function start(Course $course)
    {
        // Load the quiz and its questions for the course
        $quiz = $course->quizzes()->first(); // Assuming one quiz per course for now
        $questions = $quiz->questions; // Load questions for the quiz

        return view('quizzes.start', compact('quiz', 'questions'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $user = auth()->user();
        $totalPoints = 0;
        $questions = $quiz->questions;

        $submission = Submission::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'score' => 0
        ]);

        foreach ($questions as $question) {
            $correctAnswer = $question->answers()->where('is_correct', 1)->first();
            $userAnswerId = $request->input("answers.{$question->id}");

            if ($userAnswerId == $correctAnswer->id) {
                $totalPoints++;
            }

            SubmissionAnswer::create([
                'submission_id' => $submission->id,
                'question_id' => $question->id,
                'answer_id' => $userAnswerId
            ]);
        }

        $submission->update([
            'score' => $totalPoints
        ]);

        // Send email to the user with the result
        Mail::to($user->email)->send(new QuizResultMail($quiz, $submission));

        return redirect()->route('quizzes.result', ['quiz' => $quiz->id, 'submission' => $submission->id])
            ->with('success', "You scored $totalPoints out of " . count($questions));
    }

    public function showResult(Quiz $quiz, Submission $submission)
    {
        // Make sure the user is viewing their own submission
        if (auth()->id() !== $submission->user_id) {
            return redirect()->route('enroll.myCourses')->with('error', 'Unauthorized access to the quiz results.');
        }

        // Load the answers associated with the submission
        $submission->load('answers');

        return view('quizzes.result', compact('quiz', 'submission'));
    }
}
