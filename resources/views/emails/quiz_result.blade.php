<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Quiz Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #2C3E50;
            text-align: center;
            border-bottom: 2px solid #3498DB;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .result-summary {
            text-align: center;
            margin-bottom: 20px;
        }
        .result-summary strong {
            color: #34495E;
            font-size: 18px;
        }
        .status-btn {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            text-align: center;
            border-radius: 5px;
            font-size: 18px;
            margin-top: 20px;
        }
        .status-success {
            background-color: #2ECC71;
        }
        .status-failed {
            background-color: #E74C3C;
        }
        .question {
            margin-bottom: 20px;
        }
        .question h4 {
            color: #2980B9;
            font-size: 18px;
            margin-bottom: 10px;
        }
        .answer {
            background-color: #ecf0f1;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 5px;
        }
        .answer.correct {
            border-left: 5px solid #2ECC71;
        }
        .answer.user-answer {
            border-left: 5px solid #F39C12;
        }
        p.thanks {
            text-align: center;
            margin-top: 30px;
            font-size: 16px;
            color: #7F8C8D;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Quiz Results: {{ $quiz->title }}</h2>

    <div class="result-summary">
        <p><strong>Total Questions:</strong> {{ $quiz->questions->count() }}</p>
        <p><strong>Your Score:</strong> {{ $submission->score }} / {{ $quiz->questions->count() }}</p>

        @php
            $totalQuestions = $quiz->questions->count();
            $scorePercentage = ($submission->score / $totalQuestions) * 100;
        @endphp

        <p>
            @if($scorePercentage >= 50)
                <span class="status-btn status-success">Success</span>
            @else
                <span class="status-btn status-failed">Failed</span>
            @endif
        </p>
    </div>

    <h3>Quiz Details:</h3>
    @foreach($quiz->questions as $question)
        <div class="question">
            <h4>{{ $loop->iteration }}. {{ $question->question_text }}</h4>

            @php
                $userAnswer = $submission->answers->where('question_id', $question->id)->first();
            @endphp

            @foreach($question->answers as $answer)
                <div class="answer {{ $answer->is_correct ? 'correct' : '' }} {{ $userAnswer && $userAnswer->answer_id == $answer->id ? 'user-answer' : '' }}">
                    {{ $answer->answer_text }}
                    @if($answer->is_correct)
                        <strong>(Correct)</strong>
                    @endif
                    @if($userAnswer && $userAnswer->answer_id == $answer->id)
                        <em>(Your answer)</em>
                    @endif
                </div>
            @endforeach
        </div>
    @endforeach

    <p class="thanks">Thank you for participating in the quiz!</p>
</div>
</body>
</html>
