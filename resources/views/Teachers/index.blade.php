@extends('layouts.app')

@section('content')
<div class="container">
  <h2>All Teacherss!</h2>

  <a href="{{route ('teachers.create')}}" class="btn btn-primary mb-3">
    create new Teacher
  </a>

  @if(session('success'))
  <div class="alert alert-success">
      {{session('success')}}
  </div>
    @endif
<!-- teachers/index.blade.php -->
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Mobile</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($teachers as $teacher)
            <tr>
                @if (request('edit') == $teacher->id)
                    <!-- Editing row -->
                    <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <td>{{ $loop->iteration }}</td>
                        <td><input type="text" name="name" value="{{ $teacher->name }}"></td>
                        <td><input type="text" name="mobile" value="{{ $teacher->mobile }}"></td>
                        <td><input type="text" name="address" value="{{ $teacher->address }}"></td>
                        <td>
                            <button type="submit">Save</button>
                            <a href="{{ route('teachers.index') }}">Cancel</a>
                        </td>
                    </form>
                @else
                    <!-- Normal row -->
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->mobile }}</td>
                    <td>{{ $teacher->address }}</td>
                    <td>
                        <a href="{{ route('teachers.index', ['edit' => $teacher->id]) }}">Edit</a>
                        <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
