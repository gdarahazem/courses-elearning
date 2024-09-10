@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            Edit Answer
        </div>

        <div class="card-body">
            <form action="{{ route('admin.answers.update', [$answer->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="answer_text">Answer Text</label>
                    <input type="text" id="answer_text" name="answer_text" class="form-control" value="{{ old('answer_text', $answer->answer_text) }}" required>
                </div>
                <div class="form-group">
                    <label for="question_id">Select Question</label>
                    <select name="question_id" id="question_id" class="form-control" required>
                        @foreach($questions as $id => $question)
                            <option value="{{ $id }}" {{ $id == $answer->question_id ? 'selected' : '' }}>{{ $question }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="is_correct">Is Correct?</label>
                    <select name="is_correct" id="is_correct" class="form-control" required>
                        <option value="0" {{ $answer->is_correct ? '' : 'selected' }}>No</option>
                        <option value="1" {{ $answer->is_correct ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>
                <div>
                    <input class="btn btn-danger" type="submit" value="Save">
                </div>
            </form>
        </div>
    </div>

@endsection
