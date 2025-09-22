<!--@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Enrollment</h1>

    <form action="{{ route('enrollments.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label>Enroll No</label>
            <input type="number" name="enroll_no" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Student</label>
            <select name="student_id" class="form-control" required>
                <option value="">-- Select Student --</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Batch</label>
            <select name="batch_id" class="form-control" required>
                <option value="">-- Select Batch --</option>
                @foreach($batches as $batch)
                    <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>join Date</label>
            <input type="date" name="join_date" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>fee</label>
            <input type="text" name="fee" class="form-control" placeholder="e.g. 3500frs" required>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection