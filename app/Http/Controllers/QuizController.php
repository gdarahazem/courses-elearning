<?php

namespace App\Http\Controllers;

use App\Course;
use App\Quiz;
use App\Submission;
use App\SubmissionAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = auth()->user(); // Get the authenticated user
        $totalPoints = 0; // Variable to store total points
        $questions = $quiz->questions; // Retrieve all questions for the quiz

        // Create a new submission record
        $submission = Submission::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'score' => 0 // Temporary, will be updated after calculating the score
        ]);

        foreach ($questions as $question) {
            $correctAnswer = $question->answers()->where('is_correct', 1)->first(); // Get the correct answer for the question

            $userAnswerId = $request->input("answers.{$question->id}"); // Get the answer the user submitted

            // Check if the user's answer is correct
            if ($userAnswerId == $correctAnswer->id) {
                $totalPoints++; // Increment total points if the answer is correct
            }

            // Save the user's answer in the submission_answers table
            SubmissionAnswer::create([
                'submission_id' => $submission->id,
                'question_id' => $question->id,
                'answer_id' => $userAnswerId
            ]);
        }

        // Update the submission with the calculated score
        $submission->update([
            'score' => $totalPoints
        ]);

        // Redirect back with the result
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
