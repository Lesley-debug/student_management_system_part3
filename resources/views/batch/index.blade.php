
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Batch List</h2>

    <a href="{{ route('batch.create') }}" class="btn btn-primary mb-3">Add New Batch</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Batch Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Course</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($batches as $batch)
                <tr>
                    @if(request('edit') == $batch->id)
                    <td>{{ $batch->id }}</td>
                    <td>{{ $batch->name }}</td>
                    <td>{{ $batch->start_date }}</td>
                    <td>{{ $batch->end_date }}</td>
                    <td>{{ $batch->course->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('batch.edit', $batch->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('batch.destroy', $batch->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this batch?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No batches found</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

 @if ($errors->any())

  <ul>
    @foreach ($errors ->All() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>

  @endif