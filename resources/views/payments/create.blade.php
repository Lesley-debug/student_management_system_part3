<!--@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Payment</h1>

    <form action="{{ route('payments.store') }}" method="POST">
      @csrf
      <div class="form-group mb-3">
        <label>Enrollment</label>
        <select name="enrollment_id" id="enrollment_id" class="form-control">
          <option value="">-- Select Enrollment</option>
          @foreach($enrollments as $enrollment)
              <option value="{{$enrollment->id}}">{{$enrollment->student->name}} - {{$enrollment->batch->course->name}} ({{$enrollment->batch->name}})</option>
          @endforeach
        </select> <br>
      </div>

      <div class="form-group mb-3">
        <label>Amount</label>
        <input type="number" name="amount" id="amount" required> <br>
      </div>

      <div class="form-group mb-3">
        <label>Payment Date</label>
        <input type="date" name="payment_date" id="payment_date" required> <br>
      </div>

      <div class="form-group mb-3">
        <label for="receipt_no">Receipt Number</label>
        <input type="text" name="receipt_no" id="receipt_no"> <br>
      </div>

      <div class="form-group mb-3">
        <label for="method">Select Payment Method:</label>
        <select id="method" name="method">
          <option value="">Select Method</option>
          <option value="cash" {{ old('method')=='cash' ? 'selected' : '' }}>Cash</option>
          <option value="momo" {{ old('method')=='momo' ? 'selected' : '' }}>Mobile Money</option>
          <option value="bank" {{ old('method')=='bank' ? 'selected' : '' }}>Bank</option>
          <option value="other" {{ old('method')=='other' ? 'selected' : '' }}>Other</option>
        </select><br><br>
      </div>

      <button type="submit" class="btn btn-success">save</button>
      <a href="{{route('payments.index')}}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection