<?php

namespace App\Mail;

use App\Quiz;
use App\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuizResultMail extends Mailable
{
    use Queueable, SerializesModels;

    public $quiz;
    public $submission;

    public function __construct(Quiz $quiz, Submission $submission)
    {
        $this->quiz = $quiz;
        $this->submission = $submission;
    }

    public function build()
    {
        return $this->view('emails.quiz_result')
            ->subject('Your Quiz Results')
            ->with([
                'quiz' => $this->quiz,
                'submission' => $this->submission,
            ]);
    }
}
