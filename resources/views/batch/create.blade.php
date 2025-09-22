<!--@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Batch</h2>

    <form action="{{ route('batch.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Batch Name</label>
            <input type="text" name="name" class="form-control" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
            @error('start_date') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control" required>
            @error('end_date') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="course_id" class="form-label">Course</label>
            <select name="course_id" class="form-control" required>
                <option value="">-- Select Course --</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
            @error('course_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Save Batch</button>
        <a href="{{ route('batch.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

 @if ($errors->any())

  <ul>
    @foreach ($errors ->All() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>

  @endif

  