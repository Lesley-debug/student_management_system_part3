@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Courses</h2>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mb-3">
        Back To Dashboard
    </a>


    <!-- Add Course Button -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createCourseModal">
        Add Course
    </button>

    <!-- Courses Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Syllabus</th>
                <th>Duration</th>
                <th width="200">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->syllabus }}</td>
                <td>{{ $course->duration }}</td>
                <td>
                    <!-- View -->
                    <button class="btn btn-sm btn-info"
                        data-bs-toggle="modal"
                        data-bs-target="#viewCourseModal{{ $course->id }}">
                        View
                    </button>

                    <!-- Edit -->
                    <button class="btn btn-sm btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#editCourseModal{{ $course->id }}">
                        Edit
                    </button>

                    <!-- Delete -->
                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this course?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>

            <!-- View Modal -->
            <div class="modal fade" id="viewCourseModal{{ $course->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">View Course: {{ $course->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>ID:</strong> {{ $course->id }}</p>
                            <p><strong>Name:</strong> {{ $course->name }}</p>
                            <p><strong>Syllabus:</strong> {{ $course->syllabus }}</p>
                            <p><strong>Duration:</strong> {{ $course->duration }}</p>
                            <p><strong>Created At:</strong> {{ $course->created_at->format('d M, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div> 

            <!-- Edit Modal -->
            <div class="modal fade" id="editCourseModal{{ $course->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('courses.update', $course->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Course</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ $course->name }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Syllabus</label>
                                    <input type="text" name="syllabus" value="{{ $course->syllabus }}" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label>Duration</label>
                                    <input type="text" name="duration" value="{{ $course->duration }}" class="form-control">
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
<div class="modal fade" id="createCourseModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('courses.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Syllabus</label>
                        <input type="text" name="syllabus" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Duration</label>
                        <input type="text" name="duration" class="form-control">
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
