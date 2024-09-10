<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EnrollmentController extends Controller
{
    public function create(Course $course)
    {
        $breadcrumb = "Enroll in $course->name course";

        return view('enrollment.enroll', compact('course', 'breadcrumb'));
    }

    public function store(Request $request, Course $course)
    {
//        dd($request->all());
        // Validate user info if they are a guest
        if (auth()->guest()) {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Create a new user
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            auth()->login($user);
        }

        $user_id = auth()->id(); // Get the authenticated user's ID
        $isEnrolled = $course->enrollments()->where('user_id', $user_id)->exists();

        if ($isEnrolled) {
            return redirect()->back()->with('error', 'You are already enrolled in this course.');
        }

        // Check if the course has a price (not free)
        if ($course->price !== null && $course->price > 0) {
            // Validate payment details
            $request->validate([
                'card_number' => 'required|digits:16',
            ]);

            $payment_reference = 'PAY-' . strtoupper(Str::random(10));

            $course->enrollments()->create([
                'user_id' => $user_id,
                'status' => 'awaiting',
                'payment_reference' => $payment_reference,
                'card_number' => $request->card_number,
            ]);
        } else {

            $course->enrollments()->create([
                'user_id' => $user_id,
                'status' => 'awaiting',
            ]);
        }

        return redirect()->route('enroll.myCourses')->with('success', 'You have been successfully enrolled in the course.');
    }

    public function handleLogin(Course $course)
    {
        return redirect()->route('enroll.create', $course->id);
    }

    public function myCourses()
    {
        $breadcrumb = "My Courses";

        $userEnrollments = auth()->user()
            ->enrollments()
            ->with('course.institution')
            ->orderBy('id', 'desc')
            ->paginate(6);

        return view('enrollment.courses', compact(['breadcrumb', 'userEnrollments']));
    }
}
