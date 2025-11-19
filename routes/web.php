<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;
 use App\Http\Controllers\AdminController;
 use App\Http\Controllers\StudentLoginController;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('students', StudentController::class);
Route::resource('teachers', TeacherController::class);
Route::resource('courses', CourseController::class);
Route::resource('batch', BatchController::class);
Route::resource('enrollments', EnrollmentController::class);
Route::resource('payments', PaymentController::class);
// Preview receipt in browser
Route::get('/payments/{id}/receipt/preview', [App\Http\Controllers\PaymentController::class, 'previewReceipt'])
    ->name('payments.receipt.preview');

// Download receipt as PDF
Route::get('/payments/{id}/receipt/download', [App\Http\Controllers\PaymentController::class, 'downloadReceipt'])
    ->name('payments.receipt.download');

// Admin Login
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('auth:admin');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');


// Student Login
Route::get('/student/login', [StudentLoginController::class, 'showLoginForm'])
    ->name('student.login');
Route::post('/student/login', [StudentLoginController::class, 'login'])
    ->name('student.login.submit');

// Student Dashboard (only for authenticated students)
Route::middleware('auth:student')->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])
        ->name('student.dashboard');

    // Student Logout
    Route::post('/student/logout', [StudentLoginController::class, 'logout'])
        ->name('student.logout');
});

