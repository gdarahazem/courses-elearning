@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            Create Answer
        </div>

        <div class="card-body">
            <form action="{{ route('admin.answers.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="answer_text">Answer Text</label>
                    <input type="text" id="answer_text" name="answer_text" class="form-control" value="{{ old('answer_text') }}" required>
                </div>
                <div class="form-group">
                    <label for="question_id">Select Question</label>
                    <select name="question_id" id="question_id" class="form-control" required>
                        @foreach($questions as $id => $question)
                            <option value="{{ $id }}">{{ $question }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="is_correct">Is Correct?</label>
                    <select name="is_correct" id="is_correct" class="form-control" required>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
                <div>
                    <input class="btn btn-danger" type="submit" value="Save">
                </div>
            </form>
        </div>
    </div>

@endsection
