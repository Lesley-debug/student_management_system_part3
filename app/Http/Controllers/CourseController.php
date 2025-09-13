<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();// fetch all courses
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'syllabus' => 'required|string',
            'duration' => 'required|string|unique:courses',
        ]);

        Course::create($validated);

        return redirect()->route('courses.index')->with('success', 'Course edited successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(course $courses)
    {
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $course = course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'syllabus' => 'required|string',
            'duration' => 'required|string |unique:courses','duration'. $id
        ]);

        $course = course::findOrFail($id);
        $course->update($validated);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $courses = Course::findOrFail($id); //find the student
        $courses->delete(); //delete student

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully');
    }
}
