@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            Question Details
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>ID</th>
                    <td>{{ $question->id }}</td>
                </tr>
                <tr>
                    <th>Question Text</th>
                    <td>{{ $question->question_text }}</td>
                </tr>
                <tr>
                    <th>Quiz</th>
                    <td>{{ $question->quiz->title ?? '' }}</td>
                </tr>
                <tr>
                    <th>Correct Answer</th>
                    <td>{{ $question->correct_answer }}</td>
                </tr>
            </table>
        </div>
    </div>

@endsection
