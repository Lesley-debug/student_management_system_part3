@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Enrollments</h1>
    <a href="{{route('enrollments.create')}}" class="btn btn-primary mb-3">
        Add Enrollment
    </a>

    @if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @endif
    <table class="table table-abordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student</th>
                <th>Enrollment</th>
                <th>join_date</th>
                <th>Fee</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enrollments as $enrollment)
            <tr>
                <td>{{$enrollment->id}}</td>
                <td>{{$enrollment->student->name ?? 'N/N' }}</td>
                <td>{{$enrollment->batch->name ?? 'N/N' }}</td>
                <td>{{$enrollment->join_date}}</td>
                <td>{{$enrollment->fee}}</td>
                <td>
                    <a href="{{route('enrollments.show', $enrollment->id)}}" class=" btn btn-info btn-sm">View</a>
                    <a href="{{route('enrollments.edit', $enrollment->id)}}" class=" btn btn-warning btn-sm">Edit</a>
                    <form action="{{route('enrollments.destroy', $enrollment->id)}}" method ="POST" style ="display-inline-block">
                        @csrf

                        @method('DELETE')

                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"> DELETE </button> 

                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection