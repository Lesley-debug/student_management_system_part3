@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Teachers</h2>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mb-3">
        Back To Dashboard
    </a>


    <!-- Add Teacher Button -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createTeacherModal">
        Add Teacher
    </button>

    <!-- Teachers Table -->
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
            @foreach($teachers as $teacher)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->mobile }}</td>
                <td>{{ $teacher->address }}</td>
                <td>

                    <!-- View Button -->
                    <button class="btn btn-sm btn-warning"
                     data-bs-toggle="modal" 
                     data-bs-target="#viewTeacherModal{{ $teacher->id }}">
                        View
                    </button>

                    <!-- Edit Button -->
                    <button class="btn btn-sm btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#editTeacherModal{{ $teacher->id }}">
                        Edit
                    </button>

                    <!-- Delete -->
                    <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this teacher?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>

            <!-- View Modal -->
            <div class="modal fade" id="viewTeacherModal{{ $teacher->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">View Teacher: {{ $teacher->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>ID:</strong> {{ $teacher->id }}</p>
                            <p><strong>Name:</strong> {{ $teacher->name }}</p>
                            <p><strong>Mobile:</strong> {{ $teacher->mobile }}</p>
                            <p><strong>Address:</strong> {{ $teacher->address }}</p>
                            <p><strong>Created At:</strong> {{ $teacher->created_at->format('d M, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div> 

            <!-- Edit Modal -->
            <div class="modal fade" id="editTeacherModal{{ $teacher->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Teacher</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ $teacher->name }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Mobile</label>
                                    <input type="text" name="mobile" value="{{ $teacher->mobile }}" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label>Address</label>
                                    <input type="text" name="address" value="{{ $teacher->address }}" class="form-control">
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
<div class="modal fade" id="createTeacherModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('teachers.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Teacher</h5>
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
