@extends('layouts.app')

@section('content')
<div class="container">
    <h2>students</h2>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add student Button -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createStudentModal">
        Add student
    </button>

    <!-- students Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Address</th>
                <th width="200">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->mobile }}</td>
                <td>{{ $student->address }}</td>
                <td>

                    <!-- View Button -->
                    <button class="btn btn-sm btn-warning"
                     data-bs-toggle="modal" 
                     data-bs-target="#viewStudentModal{{ $student->id }}">
                        View
                    </button>

                    <!-- Edit Button -->
                    <button class="btn btn-sm btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#editStudentModal{{ $student->id }}">
                        Edit
                    </button>

                    <!-- Delete -->
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this student?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>

            <!-- View Modal -->
            <div class="modal fade" id="viewStudentModal{{ $student->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">View student: {{ $student->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>ID:</strong> {{ $student->id }}</p>
                            <p><strong>Name:</strong> {{ $student->name }}</p>
                            <p><strong>Mobile:</strong> {{ $student->mobile }}</p>
                            <p><strong>Address:</strong> {{ $student->address }}</p>
                            <p><strong>Created At:</strong> {{ $student->created_at->format('d M, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div> 

            <!-- Edit Modal -->
            <div class="modal fade" id="editStudentModal{{ $student->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('students.update', $student->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Student</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ $student->name }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Mobile</label>
                                    <input type="text" name="mobile" value="{{ $student->mobile }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Address</label>
                                    <input type="text" name="address" value="{{ $student->address }}" class="form-control">
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
<div class="modal fade" id="createStudentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('students.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Mobile</label>
                        <input type="text" name="mobile" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control">
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
