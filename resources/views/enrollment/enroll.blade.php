@extends('layouts.main')

@section('content')
    <style>
        .form-control {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }

        .form-control:focus {
            border-color: #5a67d8;
            box-shadow: none;
        }

        .genric-btn.primary {
            background-color: #5a67d8;
            border: none;
            padding: 12px;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .genric-btn.primary:hover {
            background-color: #4c51bf;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
    </style>

    <div class="whole-wrap">
        <div class="container box_1170">
            <div class="section-top-border">
                @if($errors->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-6">
                        <h3 class="mb-30">Submit an application for course enrollment</h3>
                        @guest
                            <p>If you have an account, login with your credentials <a href="{{ route('enroll.handleLogin', $course->id) }}">here</a>.</p>
                        @endguest
                        <form id="enrollForm" method="POST" action="{{ route('enroll.store', $course->id) }}">
                            @csrf
                            <!-- User Information Fields -->
                            <div class="mt-10 form-group">
                                <input type="text" name="name" placeholder="Name" required class="form-control"
                                       value="{{ auth()->check() ? auth()->user()->name : old('name') }}" @auth disabled @endauth>
                            </div>
                            <div class="mt-10 form-group">
                                <input type="email" name="email" placeholder="Email address" required class="form-control"
                                       value="{{ auth()->check() ? auth()->user()->email : old('email') }}" @auth disabled @endauth>
                            </div>

                            @guest
                                <div class="mt-10 form-group">
                                    <input type="password" name="password" placeholder="Password" required class="form-control">
                                </div>
                                <div class="mt-10 form-group">
                                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="form-control">
                                </div>
                            @endguest

                            <input type="hidden" name="course_id" value="{{ $course->id }}">

                            <!-- Payment Form -->
                            @if($course->price !== null)
                                <h4 class="mt-20 mb-4">Payment Information</h4>
                                <div class="mt-10 form-group">
                                    <label for="card_number">Card Number</label>
                                    <input type="text" name="card_number" id="card_number" placeholder="1234 5678 9123 4567" required class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="expiry_date">Expiry Date (MM/YY)</label>
                                        <input type="text" name="expiry_date" id="expiry_date" placeholder="MM/YY" required class="form-control">
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="cvv">CVV</label>
                                        <input type="text" name="cvv" id="cvv" placeholder="123" required class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="card_holder_name">Cardholder's Name</label>
                                    <input type="text" name="card_holder_name" id="card_holder_name" placeholder="John Doe" required class="form-control">
                                </div>
                            @endif

                            <div class="mt-10">
                                <input type="submit" class="genric-btn primary btn-block" name="submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- Include jQuery and jQuery Validation Plugin -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    <!-- jQuery Validation Script -->
    <script>
        $(document).ready(function() {
            // Custom jQuery validation method for card number
            $.validator.addMethod("creditcard", function(value, element) {
                return this.optional(element) || /^[0-9]{16}$/.test(value);
            }, "Please enter a valid 16-digit card number.");

            $("#enrollForm").validate({
                rules: {
                    card_number: {
                        required: true,
                        creditcard: true
                    },
                    expiry_date: {
                        required: true,
                        minlength: 5,
                        maxlength: 5
                    },
                    cvv: {
                        required: true,
                        minlength: 3,
                        maxlength: 4
                    },
                    card_holder_name: {
                        required: true
                    }
                },
                messages: {
                    card_number: {
                        required: "Card number is required",
                        creditcard: "Please enter a valid card number"
                    },
                    expiry_date: {
                        required: "Expiry date is required",
                        minlength: "Expiry date must be in MM/YY format",
                        maxlength: "Expiry date must be in MM/YY format"
                    },
                    cvv: {
                        required: "CVV is required",
                        minlength: "CVV must be at least 3 digits",
                        maxlength: "CVV must not exceed 4 digits"
                    },
                    card_holder_name: {
                        required: "Cardholder's name is required"
                    }
                },
                errorClass: "text-danger", // Add Bootstrap error class
                highlight: function(element) {
                    $(element).addClass('border-danger'); // Add red border on error
                },
                unhighlight: function(element) {
                    $(element).removeClass('border-danger'); // Remove red border on valid
                }
            });
        });
    </script>
@endsection
