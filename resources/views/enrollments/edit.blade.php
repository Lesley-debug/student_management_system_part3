@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Enrollment</h1>

    <form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label>Student</label>
            <select name="student_id" class="form-control" required>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $enrollment->student_id == $student->id ? 'selected' : '' }}>
                        {{ $student->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Batch</label>
            <select name="batch_id" class="form-control" required>
                @foreach($batches as $batch)
                    <option value="{{ $batch->id }}" {{ $enrollment->batch_id == $batch->id ? 'selected' : '' }}>
                        {{ $batch->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label>Enrollment Date</label>
            <input type="date" name="enrollment_date" value="{{ $enrollment->enrollment_date }}" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label>Status</label>
            <input type="text" name="status" value="{{ $enrollment->status }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection