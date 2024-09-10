@extends('layouts.main')

@section('content')
    <section class="quiz_result_area section_padding">
        <div class="container">
            <h2>Quiz Result: {{ $quiz->title }}</h2>

            @php
                $totalQuestions = $quiz->questions->count();
                $score = $submission->score;
                $scorePercentage = ($totalQuestions > 0) ? ($score / $totalQuestions) * 100 : 0;
            @endphp

            <div class="result_summary">
                <p><strong>Total Questions:</strong> {{ $totalQuestions }}</p>
                <p><strong>Your Score:</strong> {{ $score }} / {{ $totalQuestions }} ({{ round($scorePercentage, 2) }}%)</p>

                <p>
                    @if($scorePercentage >= 50)
                        <span class="badge badge-success">Succeeded</span>
                    @else
                        <span class="badge badge-danger">Failed</span>
                    @endif
                </p>
            </div>

            <h3>Your Answers</h3>
            @foreach($quiz->questions as $question)
                <div class="question_result mb-4">
                    <h4>{{ $loop->iteration }}. {{ $question->question_text }}</h4>

                    @php
                        $userAnswer = $submission->answers->where('question_id', $question->id)->first(); // Get the user's answer for this question
                    @endphp

                    @foreach($question->answers as $answer)
                        <div class="form-check">
                            <input
                                class="form-check-input"
                                type="radio"
                                name="answers[{{ $question->id }}]"
                                value="{{ $answer->id }}"
                                {{ $userAnswer && $answer->id == $userAnswer->answer_id ? 'checked' : '' }}
                                disabled>
                            <label class="form-check-label">
                                {{ $answer->answer_text }}
                                @if($answer->is_correct)
                                    <span class="text-success">(Correct)</span>
                                @endif
                                @if($userAnswer && $answer->id == $userAnswer->answer_id && !$answer->is_correct)
                                    <span class="text-danger">(Your Answer)</span>
                                @endif
                            </label>
                        </div>
                    @endforeach
                </div>
            @endforeach

            <a href="{{ route('enroll.myCourses') }}" class="btn_1 d-block mt-4">Go Back to Quizzes</a>
        </div>
    </section>
@endsection
