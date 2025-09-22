<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Batch;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with(['student', 'batch'])->get();

        // needed for inline edit selects
        $students = Student::all();
        $batches  = Batch::all();

        return view('enrollments.index', compact('enrollments', 'students', 'batches'));
    }

    /*
        show the form for creating a new enrollments
    */
    public function create()
    {
        $students = Student::all();
        $batches = Batch::all();
        return view('enrollments.create', compact('students', 'batches'));
    }

    /*
        store a newly created enrollment in storage
    */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'enroll_no' => 'required|string|max:50',
            'student_id' => 'required|exists:students,id',
            'batch_id' => 'required|exists:batches,id',
            'join_date' => 'required|date',
            'fee' => 'required|string|max:50',
        ]);

        Enrollment::create($validated);
        return redirect()->route('enrollments.index')->with('success', 'Enrollment created successfully');
    }

    /* 
        display the specified enrollment
    */

    public function show(Enrollment $enrollment)
    {
        $enrollment->load(['student', 'batch']);
        return view('enrollments.show', compact('enrollment'));
    }

    /*
        show the form for editing the specified enrollment
    */
    public function edit(Enrollment $enrollment)
    {
        $students = Student::all();
        $batches = Batch::all();

        return view('enrollments.edit', compact('enrollment', 'students', 'batches'));
    }

    /*
       update the specified enrollment in storage. 
    */
    
       public function update(Request $request, Enrollment $enrollment)
       {
        $validated = $request->validate([
            'enroll_no' => 'required|string|max:50',
            'student_id' => 'required|exists:students,id',
            'batch_id' => 'required|exists:batches,id',
            'join_date' => 'required|date',
            'fee' => 'required|string|max:50',
        ]);

        $enrollment->update($validated);

        return redirect()->route('enrollments.index')->with('success', 'Enrollment updated successfully');
       }

       /*
            remove the specified enrollment from the storage
       */

        public function destroy(Enrollment $enrollment)
        {
            $enrollment->delete();
            return redirect()->route('enrollments.index')->with('success', 'Enrollment deleted successfully');
        }
}
