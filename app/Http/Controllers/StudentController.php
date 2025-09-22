<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Batch;
use App\Models\Student;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = student::all();//fetch all student from database
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|unique:students,mobile',
            'address' => 'required|string',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $students)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $student = student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'mobile' => 'required|string|unique:students,mobile,' . $id,
            'address'=> 'required|string',
        ]);

        $student = Student::findOrFail($id);
        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Student updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $students = Student::findOrFail($id); //find the student
        $students->delete(); //delete student

        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }
}
