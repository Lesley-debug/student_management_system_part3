@extends('layouts.app')

@section('content')
  
  @if(session('success'))
  <div class="alert alert-success">
      {{session('success')}}
  </div>
    @endif
  
    <a href="{{route ('courses.create')}}">
       Create new Course

    </a>
    <h2>All Courses!</h2>

<!-- resources/views/courses/index.blade.php -->
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Course Name</th>
            <th>Syllabus</th>
            <th>Duration</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($courses as $course)
            <tr>
                @if (request('edit') == $course->id)
                    <form action="{{ route('courses.update', $course->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <td>{{ $loop->iteration }}</td>
                        <td><input type="text" name="name" value="{{ $course->name }}"></td>
                        <td><input type="text" name="syllabus" value="{{ $course->syllabus }}"></td>
                        <td><input type="text" name="duration" value="{{ $course->duration }}"></td>
                        <td>
                            <button type="submit">Save</button>
                            <a href="{{ route('courses.index') }}">Cancel</a>
                        </td>
                    </form>
                @else
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->syllabus }}</td>
                    <td>{{ $course->duration }}</td>
                    <td>
                        <a href="{{ route('courses.index', ['edit' => $course->id]) }}">Edit</a>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline">
                            @csrf @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
@endsection