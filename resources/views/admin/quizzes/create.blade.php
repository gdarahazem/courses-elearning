@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} Quiz
        </div>

        <div class="card-body">
            <form action="{{ route('admin.quizzes.store') }}" method="POST">
                @csrf
                <!-- Title Field -->
                <div class="form-group">
                    <label for="title">Quiz Title*</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}" required>
                    @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                    @endif
                </div>

                <!-- Description Field -->
                <div class="form-group">
                    <label for="description">Description (Optional)</label>
                    <textarea id="description" name="description" class="form-control">{{ old('description') }}</textarea>
                </div>

                <!-- Course Dropdown -->
                <div class="form-group">
                    <label for="course_id">Associated Course*</label>
                    <select id="course_id" name="course_id" class="form-control select2" required>
                        @foreach($courses as $id => $course)
                            <option value="{{ $id }}" {{ old('course_id') == $id ? 'selected' : '' }}>{{ $course }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('course_id'))
                        <span class="text-danger">{{ $errors->first('course_id') }}</span>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save Quiz</button>
                    <a href="{{ route('admin.quizzes.index') }}" class="btn btn-default">Cancel</a>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#course_id').select2();
        });
    </script>
@endsection
