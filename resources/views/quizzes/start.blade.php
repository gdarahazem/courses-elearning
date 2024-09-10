@extends('layouts.main')

@section('content')
    <section class="quiz_area section_padding">
        <div class="container">
            <h2>{{ $quiz->title }}</h2>
            <form action="{{ route('quizzes.submit', ['quiz' => $quiz->id]) }}" method="POST">
                @csrf
                @foreach($questions as $question)
                    <div class="question mb-4">
                        <h4>{{ $loop->iteration }}. {{ $question->question_text }}</h4>
                        @foreach($question->answers as $answer)
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="answers[{{ $question->id }}]"
                                    id="answer{{ $answer->id }}"
                                    value="{{ $answer->id }}"
                                    required>
                                <label class="form-check-label" for="answer{{ $answer->id }}">
                                    {{ $answer->answer_text }}
                                </label>
                            </div>
                        @endforeach

                        @error("answers.{$question->id}")
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                @endforeach

                <button type="submit" class="btn_1 d-block mt-4">Submit Quiz</button>
            </form>
        </div>
    </section>
@endsection
