<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use App\Models\Batch;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Teacher;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'studentsCount' => Student::count(),
            'coursesCount' => Course::count(),
            'batchesCount' => Batch::count(),
            'enrollmentsCount' => Enrollment::count(),
            'paymentsCount' => Payment::count(),
            'teachersCount' => Teacher::count(),
        ]);
    }
}
