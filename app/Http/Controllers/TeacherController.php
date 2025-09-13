<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Teacher;
use Illuminate\Http\Request;


class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = teacher::all();//fetch all teacher from database
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|unique:teachers',
            'address' => 'required|string',
        ]);

        teacher::create($validated);

        return redirect()->route('teachers.index')->with('success', 'teacher created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(teacher $teachers)
    {
        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $teacher = teacher::findOrFail($id);
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'   => 'required|string|max:255',
            'mobile' => 'required|string|unique:teachers,mobile,' . $id,
            'address'=> 'required|string',
        ]);

        $teacher = teacher::findOrFail($id);
        $teacher->update($validated);

        return redirect()->route('teachers.index')->with('success', 'teacher updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $teachers = teacher::findOrFail($id); //find the teacher
        $teachers->delete(); //delete teacher

        return redirect()->route('teachers.index')->with('success', 'teacher deleted successfully');
    }
}
