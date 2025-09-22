<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index()
    {
        $batches = Batch::with('course')->get();

        $courses = Course::all();
        return view('batch.index', compact('batches', 'courses'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('batch.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'course_id' => 'required|exists:courses,id',
            
        ]);

        Batch::create($validated);

        return redirect()->route('batch.index')->with('success', 'Batch created successfully');
    }

    public function edit($id)
    {
        $batch = Batch::findOrFail($id);
        $courses = Course::all();
        return view('batch.edit', compact('batch', 'courses'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'course_id' => 'required|exists:courses,id',
        ]);

        $batch = Batch::findOrFail($id);
        $batch->update($validated);

        return redirect()->route('batch.index')->with('success', 'Batch updated successfully');
    }

    public function destroy($id)
    {
        $batch = Batch::findOrFail($id);
        $batch->delete();

        return redirect()->route('batch.index')->with('success', 'Batch deleted successfully');
    }
}
