@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            Create Question
        </div>

        <div class="card-body">
            <form action="{{ route('admin.questions.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="question_text">Question Text</label>
                    <input type="text" id="question_text" name="question_text" class="form-control" value="{{ old('question_text') }}" required>
                </div>
                <div class="form-group">
                    <label for="quiz_id">Select Quiz</label>
                    <select name="quiz_id" id="quiz_id" class="form-control" required>
                        @foreach($quizzes as $id => $quiz)
                            <option value="{{ $id }}">{{ $quiz }}</option>
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
