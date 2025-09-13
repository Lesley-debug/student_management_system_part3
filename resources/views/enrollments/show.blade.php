@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Enrollment Details</h1>

    <p><strong>ID:</strong> {{ $enrollment->id }}</p>
    <p><strong>Entoll No:</strong> {{ $enrollment->enroll_no }}</p>
    <p><strong>Student:</strong> {{ $enrollment->student->name ?? 'N/A' }}</p>
    <p><strong>Batch:</strong> {{ $enrollment->batch->name ?? 'N/A' }}</p>
    <p><strong>join Date:</strong> {{ $enrollment->join_date }}</p>
    <p><strong>Fee:</strong> {{ $enrollment->fee }}</p>

    <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection