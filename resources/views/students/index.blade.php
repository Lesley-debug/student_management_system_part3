@extends('layouts.app')

@section('content')
<div class="container">
  <h2>All students!</h2>

  <a href="{{route ('students.create')}}" class="btn btn-primary mb-3">
    create new student
  </a>

  @if(session('success'))
  <div class="alert alert-success">
      {{session('success')}}
  </div>
    @endif
<!-- students/index.blade.php -->
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
        @foreach ($students as $student)
            <tr>
                @if (request('edit') == $student->id)
                    <!-- Editing row -->
                    <form action="{{ route('students.update', $student->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <td>{{ $loop->iteration }}</td>
                        <td><input type="text" name="name" value="{{ $student->name }}"></td>
                        <td><input type="text" name="mobile" value="{{ $student->mobile }}"></td>
                        <td><input type="text" name="address" value="{{ $student->address }}"></td>
                        <td>
                            <button type="submit">Save</button>
                            <a href="{{ route('students.index') }}">Cancel</a>
                        </td>
                    </form>
                @else
                    <!-- Normal row -->
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->mobile }}</td>
                    <td>{{ $student->address }}</td>
                    <td>
                        <a href="{{ route('students.index', ['edit' => $student->id]) }}">Edit</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline">
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