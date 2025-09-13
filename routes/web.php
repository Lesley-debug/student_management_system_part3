<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::Resource('students', StudentController::class);
Route::Resource('teachers', TeacherController::class);
Route::Resource('courses', CourseController::class);
Route::Resource('batch', BatchController::class);
Route::Resource('enrollments', EnrollmentController::class);
Route::Resource('payments', PaymentController::class);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::Get('payments/{payment}/receipt', [PaymentController::class, 'downloadreceipt'])->name('payments.receipt');