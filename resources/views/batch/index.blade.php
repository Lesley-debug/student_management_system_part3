@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Batches</h2>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mb-3">
        Back To Dashboard
    </a>

    <!-- Add Batch Button -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createBatchModal">
        Add Batch
    </button>

    <!-- Batches Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Course</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th width="200">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($batches as $batch)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $batch->name }}</td>
                <td>{{ $batch->course->name ?? 'N/A' }}</td>
                <td>{{ $batch->start_date }}</td>
                <td>{{ $batch->end_date }}</td>
                <td>
                    <!-- View -->
                    <button class="btn btn-sm btn-info"
                        data-bs-toggle="modal"
                        data-bs-target="#viewBatchModal{{ $batch->id }}">
                        View
                    </button>

                    <!-- Edit -->
                    <button class="btn btn-sm btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#editBatchModal{{ $batch->id }}">
                        Edit
                    </button>

                    <!-- Delete -->
                    <form action="{{ route('batch.destroy', $batch->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this batch?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>

            <!-- View Modal -->
            <div class="modal fade" id="viewBatchModal{{ $batch->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">View Batch: {{ $batch->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>ID:</strong> {{ $batch->id }}</p>
                            <p><strong>Name:</strong> {{ $batch->name }}</p>
                            <p><strong>Course:</strong> {{ $batch->course->name ?? 'N/A' }}</p>
                            <p><strong>Start Date:</strong> {{ $batch->start_date }}</p>
                            <p><strong>End Date:</strong> {{ $batch->end_date }}</p>
                            <p><strong>Created At:</strong> {{ $batch->created_at->format('d M, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div> 

            <!-- Edit Modal -->
            <div class="modal fade" id="editBatchModal{{ $batch->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('batch.update', $batch->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Batch</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ $batch->name }}" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Course</label>
                                    <select name="course_id" class="form-control" required>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}" {{ $batch->course_id == $course->id ? 'selected' : '' }}>
                                                {{ $course->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Start Date</label>
                                    <input type="text" name="start_date" value="{{ $batch->start_date }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>End Date</label>
                                    <input type="text" name="end_date" value="{{ $batch->end_date }}" class="form-control">
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
<div class="modal fade" id="createBatchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('batch.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Batch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Course</label>
                        <select name="course_id" class="form-control" required>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Start Date</label>
                        <input type="date" name="start_date" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>End Date</label>
                        <input type="date" name="end_date" class="form-control">
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