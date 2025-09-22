<!--
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Batch</h2>

    <form action="{{ route('batch.edit', $batch->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Batch Name</label>
            <input type="text" name="name" class="form-control" value="{{ $batch->name }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>        

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" value="{{ $batch->start_date }}" required>
            @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control" value="{{ $batch->end_date }}" required>
            @error('end_date') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="course_id" class="form-label">Course</label>
            <select name="course_id" class="form-control" required>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ $batch->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
            @error('course_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Update Batch</button>
        <a href="{{ route('batch.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
