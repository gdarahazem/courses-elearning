@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            Edit Question
        </div>

        <div class="card-body">
            <form action="{{ route('admin.questions.update', $question->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="question_text">Question Text</label>
                    <input type="text" id="question_text" name="question_text" class="form-control" value="{{ old('question_text', $question->question_text) }}" required>
                </div>
                <div class="form-group">
                    <label for="quiz_id">Select Quiz</label>
                    <select name="quiz_id" id="quiz_id" class="form-control" required>
                        @foreach($quizzes as $id => $quiz)
                            <option value="{{ $id }}" {{ $id == $question->quiz_id ? 'selected' : '' }}>{{ $quiz }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <input class="btn btn-danger" type="submit" value="Save">
                </div>
            </form>
        </div>
    </div>

@endsection
