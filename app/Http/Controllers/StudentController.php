<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Admin;
use App\Models\Enrollment;
use App\Models\Payment;
use App\Models\Course;
use App\Models\Teacher;

class StudentController extends Controller
{
    /**
     * Display a listing of the students.
     */
    public function index()
    {
        // Fetch all students from the database
        dd(Student::all());
        $students = Student::all();

        // Pass the students data to the index view
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        // Show the create student form
        return view('students.create');
    }

    /**
     * Store a newly created student in the database.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:students,email',
            'password' => 'required|string|min:6',
            'mobile'   => 'required|string|unique:students,mobile',
            'address'  => 'required|string',
        ]);

        // Hash the password before saving
        $validated['password'] = bcrypt($validated['password']);

        // Create the student record
        Student::create($validated);

        // Redirect back to student index with success message
        return redirect()->route('students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        // Pass the student to the show view
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified student.
     */
    public function edit($id)
    {
        // Find student by ID or fail
        $student = Student::findOrFail($id);

        // Pass student data to the edit view
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified student in the database.
     */
    public function update(Request $request, $id)
    {
        // Validate the data
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:students,email,' . $id, // allow current email
            'mobile'  => 'required|string|unique:students,mobile,' . $id,
            'address' => 'required|string',
            'password'=> 'nullable|string|min:6', // optional password update
        ]);

        // Find the student
        $student = Student::findOrFail($id);

        // Hash password if provided
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        } else {
            // Remove password from array if not provided to avoid overwriting
            unset($validated['password']);
        }

        // Update student
        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified student from the database.
     */
    public function destroy($id)
    {
        // Find the student
        $student = Student::findOrFail($id);

        // Delete the student
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }

public function dashboard()
{
    $student = auth()->guard('student')->user();

    $totalCourses = $student->enrollments()->count();

    $totalTeachers = $student->enrollments()
        ->with('batch.teacher')
        ->get()
        ->pluck('batch.teacher.id')
        ->filter()
        ->unique()
        ->count();

    $totalPayments = $student->payments()->sum('amount');

    return view('students.dashboard', compact(
        'student',
        'totalCourses',
        'totalTeachers',
        'totalPayments'
    ));
}


}
