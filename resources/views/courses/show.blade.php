@extends('layouts.main')

@section('content')

    <section class="course_details_area section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 course_details_left">
                    <div class="main_image">
                        <img class="img-fluid" src="{{ optional($course->photo)->getUrl() ?? asset('img/no_image.png') }}" alt="">
                    </div>
                    <div class="content_wrapper">
                        <h4 class="title_top">Description</h4>
                        <div class="content">
                            {{ $course->description ?? 'No description provided' }}
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 right-contents">
                    <div class="sidebar_top">
                        <ul>
                            <li>
                                <a class="justify-content-between d-flex">
                                    <p>Course Fee</p>
                                    <span>{{ $course->getPrice() }}</span>
                                </a>
                            </li>
                            @if($enrollmentStatus)
                                <li>
                                    <p>Enrollment Status: <strong>{{ ucfirst($enrollmentStatus) }}</strong></p>
                                </li>
                            @endif
                        </ul>

                        @if($enrollmentStatus === 'accepted' && $bookUrl)
                            <a href="{{ $bookUrl }}" class="btn_1 d-block" download>Download Book</a>
                            <a href="{{ $bookUrl }}" target="_blank" class="btn_1 d-block">Read Online</a>
                        @elseif(!$enrollmentStatus)
                            <a href="{{ route('enroll.create', $course->id) }}" class="btn_1 d-block">Enroll in the Course</a>
                        @endif

                        {{-- Display Pass the Exam or Repas Exam button based on the latest submission --}}
                        @if(auth()->check() && $hasQuiz)
                            @if($latestSubmission)
                                @php
                                    $totalQuestions = $course->quizzes()->first()->questions->count();
                                    $passScore = $totalQuestions * 0.5; // Assuming 50% is the pass score
                                @endphp

                                @if($latestSubmission->score >= $passScore)
                                    <div class="alert alert-success" style="margin-top: 10px;">
                                        You have successfully passed the exam with a score of {{ $latestSubmission->score }}/{{ $totalQuestions }}.
                                    </div>
                                @else
                                    <a href="{{ route('quizzes.start', ['course' => $course->id]) }}" class="btn_1 d-block">Retake the Exam</a>
                                    <div class="alert alert-danger" style="margin-top: 10px">
                                        You failed the exam. Your score was {{ $latestSubmission->score }}/{{ $totalQuestions }}.
                                    </div>
                                @endif
                            @else
                                <a href="{{ route('quizzes.start', ['course' => $course->id]) }}" class="btn_1 d-block">Pass the Exam</a>
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
