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