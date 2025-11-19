<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.student-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('student')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('student.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('student')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function index()
    {
        $student = Auth::guard('student')->user();

        // Get enrollments with course & teacher
        $enrollments = $student->enrollments()->with('course.teacher')->get();

        // Payments
        $payments = $student->payments()->orderBy('payment_date', 'desc')->get();

        // Total paid
        $totalPaid = $payments->sum('amount');

        // Total courses
        $totalCourses = $enrollments->count();

        // Total unique teachers
        $totalTeachers = $enrollments->pluck('course.teacher.id')->unique()->count();

        // Total fees
        $totalFee = $enrollments->sum(fn($e) => $e->course->fee ?? 0);

        // Balance
        $balance = $totalFee - $totalPaid;

        return view('student.dashboard', compact(
            'enrollments', 'payments', 'totalPaid', 'balance', 'totalCourses', 'totalTeachers'
        ));
    }
}
