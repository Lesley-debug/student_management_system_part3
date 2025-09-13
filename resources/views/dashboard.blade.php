@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">📊 Dashboard</h1>

    <div class="row">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h4>{{ $studentsCount }}</h4>
                    <p>Students</p>
                    <a href="{{ route('students.index') }}" class="btn btn-sm btn-primary">Manage</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h4>{{ $teachersCount }}</h4>
                    <p>Teachers</p>
                    <a href="{{ route('teachers.index') }}" class="btn btn-sm btn-primary">Manage</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h4>{{ $coursesCount }}</h4>
                    <p>Courses</p>
                    <a href="{{ route('courses.index') }}" class="btn btn-sm btn-primary">Manage</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h4>{{ $batchesCount }}</h4>
                    <p>Batches</p>
                    <a href="{{ route('batch.index') }}" class="btn btn-sm btn-primary">Manage</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h4>{{ $enrollmentsCount }}</h4>
                    <p>Enrollments</p>
                    <a href="{{ route('enrollments.index') }}" class="btn btn-sm btn-primary">Manage</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 mt-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h4>{{ $paymentsCount }}</h4>
                    <p>Payments</p>
                    <a href="{{ route('payments.index') }}" class="btn btn-sm btn-primary">Manage</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
