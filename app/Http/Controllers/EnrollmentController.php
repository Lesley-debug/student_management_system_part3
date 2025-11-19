<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $enrollments = Enrollment::with(['student', 'batch', 'course'])->get(); // ✅ include course
    $students = Student::all();
    $batches = Batch::all();
    $courses = Course::all();

    // Generate next enrollment number automatically
    $lastEnroll = Enrollment::latest('id')->first();
    $nextEnrollNo = 'ENR-' . str_pad(($lastEnroll ? $lastEnroll->id + 1 : 1), 4, '0', STR_PAD_LEFT);

    // ✅ Make sure to pass nextEnrollNo
        return view('enrollments.index', compact('enrollments', 'students', 'batches', 'courses', 'nextEnrollNo'));
    }


        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            return view('enrollment.create');
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'batch_id' => 'required|exists:batches,id',
            'join_date' => 'required|date',
            'fee' => 'required|numeric|min:0',
            'enroll_no' => 'nullable|string',
        ]);

        // If enroll_no was not passed, generate it
        if (empty($validated['enroll_no'])) {
            $year = date('Y');
            $lastEnrollment = Enrollment::whereYear('created_at', $year)
                ->orderBy('id', 'desc')
                ->first();
            
            $sequence = $lastEnrollment ? (int)substr($lastEnrollment->enroll_no, -4) + 1 : 1;
            $validated['enroll_no'] = 'ENR' . $year . str_pad($sequence, 4, '0', STR_PAD_LEFT);
        }

        // ✅ Save the record
        Enrollment::create($validated);

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Enrollment created successfully!');
    } catch (\Exception $e) {
        return redirect()
            ->route('enrollments.index')
            ->withInput()
            ->withErrors(['error' => 'Failed to create enrollment: ' . $e->getMessage()]);
    }
}


    /**
     * Display the specified resource.
     */
    public function show(Enrollment $enrollment)
    {
        return view('enrollment.show', compact('enrollment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        $students = Student::all();
        $batches = Batch::all();
        $courses = Course::all();   
        return view('enrollments.edit', compact('enrollment', 'students', 'batches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    try {
        $validated = $request->validate([
            'enroll_no' => 'required|string|unique:enrollments,enroll_no,' . $id,
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'batch_id' => 'required|exists:batches,id',
            'join_date' => 'required|date',
            'fee' => 'required|numeric|min:0'
        ]);

        $enrollment = Enrollment::findOrFail($id);

        $updated = $enrollment->update($validated);

        if ($updated) {
            return redirect()->route('enrollments.index')->with('success', 'Enrollment updated successfully.');
        } else {
            return back()->withErrors(['error' => 'Update failed — no changes were detected.']);
        }

    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Update failed: ' . $e->getMessage()]);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('enrollments.index')->with('success', 'Enrollment deleted successfully');
    }
}
