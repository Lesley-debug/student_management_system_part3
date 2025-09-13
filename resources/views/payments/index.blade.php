@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Payment list</h2>

    <a href="{{route('payments.create')}}" class="btn btn-primary mb-3">
      Add New Payment
    </a>
    @if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
    @endif
    <table class="table table-abordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Receipt No</th>
          <th>Student</th>
          <th>Course</th>
          <th>Batch</th>
          <th>Amount</th>
          <th>Payment_date</th>
          <th>Method</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($payments as $payment)
          <tr>
            <td>{{$loop -> iteration}}</td>
            <td>{{$payment->receipt_no}}</td>
            <td>{{$payment->enrollment?->student->name ?? 'N/A' }}</td>
            <td>{{$payment->enrollment?->batch->course->name ?? 'N/A' }}</td>
            <td>{{$payment->enrollment?->batch->name ?? 'N/A' }}</td>
            <td>{{$payment->amount}}</td>
            <td>{{$payment->payment_date}}</td>
            <td>{{$payment->method}}</td>
            <td>
                <a href="{{route('payments.show', $payment->id)}}" class=" btn btn-info btn-sm">View</a>
                <a href="{{route('payments.edit', $payment->id)}}" class=" btn btn-warning btn-sm">Edit</a>
                <a href="{{route('payments.receipt', $payment->id)}}">Print Receipt</a>
                <form action="{{route('payments.destroy', $payment->id)}}" method="post" style="display:inline-block">
                  @csrf

                  @method('DELETE')

                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are y0u sure?')" class="btn btn-sm btn-danger">DELETE</button>
                </form>
            </td>
          </tr>
          @empty
          <tr><td colspan="6" class="text-center">
              No payments found
          </td></tr>
        @endforelse
      </tbody>
    </table>
    @endsection
</div>