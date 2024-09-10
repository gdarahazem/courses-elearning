@extends('layouts.main')

@section('content')
    <style>
        .single_special_cource {
            border: 1px solid #ddd; /* Add a subtle border */
            border-radius: 10px; /* Rounded corners */
            overflow: hidden; /* Ensures content doesn't overflow the border */
            transition: box-shadow 0.3s ease; /* Smooth transition for the hover effect */
        }

        .single_special_cource:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15); /* Box shadow on hover */
        }

        .special_img {
            border-bottom: 1px solid #ddd; /* Border separating image from the text */
            border-top-left-radius: 10px;
            border-top-right-radius: 10px; /* Rounded top corners for the image */
            width: 100%; /* Ensure the image takes full width */
            height: 360px; /* Set a fixed height for consistency */
            object-fit: cover; /* Ensure the image is cropped nicely */
        }

        .special_cource_text {
            padding: 20px;
        }

        .special_cource_text h3 {
            font-size: 20px;
            font-weight: bold;
        }

        .special_cource_text h4 {
            color: #5a67d8; /* Color for the price */
            font-weight: bold;
        }

        .btn_4 {
            background-color: #5a67d8;
            color: white;
            border-radius: 20px; /* Make buttons rounded */
            padding: 5px 15px;
            text-transform: capitalize;
        }

        .btn_4:hover {
            background-color: #4c51bf;
            color: white;
        }

        .author_info p {
            font-weight: bold;
            margin-bottom: 0;
        }

        .author_info h5 {
            font-size: 18px;
            color: #5a67d8;
        }
    </style>

    <section class="special_cource padding_top">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-5">
                    <div class="section_tittle text-center">
                        <h2>My Course Enrollment Applications</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($userEnrollments as $enrollment)
                    <div class="col-sm-6 col-lg-4">
                        <div class="single_special_cource">
                            <img src="{{ optional($enrollment->course->photo)->getUrl() ?? asset('img/no_image.png') }}" class="special_img" alt="">
                            <div class="special_cource_text">
                                @foreach($enrollment->course->disciplines as $discipline)
                                    <a href="{{ route('courses.index') }}?discipline={{ $discipline->id }}" class="btn_4 mr-1 mb-1">{{ $discipline->name }}</a>
                                @endforeach
                                <h4>{{ $enrollment->course->getPrice() }}</h4>
                                <a href="{{ route('courses.show', $enrollment->course->id) }}"><h3>{{ $enrollment->course->name }}</h3></a>
                                <p style="height: 50px;">{{ Str::limit($enrollment->course->description, 100) }}</p>
                                <div class="author_info">
                                    <p>Status:</p>
                                    <h5>{{ App\Enrollment::STATUS_RADIO[$enrollment->status] }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="float-right">
                        {{ $userEnrollments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
