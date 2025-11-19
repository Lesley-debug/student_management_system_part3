<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use App\Models\Student;
use App\Models\Course;
use App\Models\Batch;
use App\Models\Payment;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    // Show admin login page
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Handle admin login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid credentials');
    }

    // Logout
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('home');
    }

    // Show admin dashboard

    public function dashboard()
{
    $totalStudents = Student::count();
    $totalCourses = Course::count();
    $totalBatches = Batch::count();
    $totalPayments = Payment::sum('amount');

    // Enrollments by course
    $enrollmentsByCourse = Course::withCount('enrollments')
                                ->get()
                                ->pluck('enrollments_count', 'name');

    // Monthly payments
    $monthlyPayments = Payment::selectRaw('MONTH(payment_date) as month, SUM(amount) as total')
                              ->groupBy('month')
                              ->pluck('total', 'month');

    // Format month names
    $monthlyPayments = $monthlyPayments->mapWithKeys(function($total, $month) {
        return [date('M', mktime(0,0,0,$month,1)) => $total];
    });

    return view('admin.dashboard', compact(
        'totalStudents',
        'totalCourses',
        'totalBatches',
        'totalPayments',
        'enrollmentsByCourse',
        'monthlyPayments'
    ));
}

}
