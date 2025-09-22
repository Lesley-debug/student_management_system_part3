@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Enrollments</h2>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Enrollment Button -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createEnrollmentModal">
        Add Enrollment
    </button>

    <!-- Enrollments Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Enroll No</th>
                <th>Student</th>
                <th>Batch</th>
                <th>Join Date</th>
                <th>Fee</th>
                <th width="200">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enrollments as $enrollment)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $enrollment->enroll_no }}</td>
                <td>{{ $enrollment->student->name ?? 'N/A' }}</td>
                <td>{{ $enrollment->batch->name ?? 'N/A' }}</td>
                <td>{{ $enrollment->join_date }}</td>
                <td>{{ $enrollment->fee }}</td>
                <td>
                    <!-- View -->
                    <button class="btn btn-sm btn-info"
                        data-bs-toggle="modal"
                        data-bs-target="#viewEnrollmentModal{{ $enrollment->id }}">
                        View
                    </button>

                    <!-- Edit -->
                    <button class="btn btn-sm btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#editEnrollmentModal{{ $enrollment->id }}">
                        Edit
                    </button>

                    <!-- Delete -->
                    <form action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this enrollment?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>

            <!-- View Modal -->
            <div class="modal fade" id="viewEnrollmentModal{{ $enrollment->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">View Enrollment: {{ $enrollment->enroll_no }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>ID:</strong> {{ $enrollment->id }}</p>
                            <p><strong>Enroll No:</strong> {{ $enrollment->enroll_no }}</p>
                            <p><strong>Student:</strong> {{ $enrollment->student->name ?? 'N/A' }}</p>
                            <p><strong>Batch:</strong> {{ $enrollment->batch->name ?? 'N/A' }}</p>
                            <p><strong>Join Date:</strong> {{ $enrollment->join_date }}</p>
                            <p><strong>Fee:</strong> {{ $enrollment->fee }}</p>
                            <p><strong>Created At:</strong> {{ $enrollment->created_at->format('d M, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div> 

            <!-- Edit Modal -->
            <div class="modal fade" id="editEnrollmentModal{{ $enrollment->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Enrollment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Enroll No</label>
                                    <input type="text" name="enroll_no" value="{{ $enrollment->enroll_no }}" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Student</label>
                                    <select name="student_id" class="form-control" required>
                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}" {{ $enrollment->student_id == $student->id ? 'selected' : '' }}>
                                                {{ $student->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Batch</label>
                                    <select name="batch_id" class="form-control" required>
                                        @foreach($batches as $batch)
                                            <option value="{{ $batch->id }}" {{ $enrollment->batch_id == $batch->id ? 'selected' : '' }}>
                                                {{ $batch->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Join Date</label>
                                    <input type="date" name="join_date" value="{{ $enrollment->join_date }}" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Fee</label>
                                    <input type="number" name="fee" value="{{ $enrollment->fee }}" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createEnrollmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('enrollments.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Enrollment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Enroll No</label>
                        <input type="text" name="enroll_no" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Student</label>
                        <select name="student_id" class="form-control" required>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Batch</label>
                        <select name="batch_id" class="form-control" required>
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Join Date</label>
                        <input type="date" name="join_date" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Fee</label>
                        <input type="number" name="fee" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection