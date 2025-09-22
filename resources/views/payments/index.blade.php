@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Payments</h2>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Add Payment Button -->
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createPaymentModal">
        Add Payment
    </button>

    <!-- Payments Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Receipt No</th>
                <th>Enrollment</th>
                <th>Amount</th>
                <th>Payment Date</th>
                <th>Method</th>
                <th width="250">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $payment->receipt_no }}</td>
                <td>{{ $payment->enrollment->enroll_no ?? 'N/A' }}</td>
                <td>{{ $payment->amount }}</td>
                <td>{{ $payment->payment_date }}</td>
                <td>{{ $payment->method }}</td>
                <td>
                    <!-- View -->
                    <button class="btn btn-sm btn-info"
                        data-bs-toggle="modal"
                        data-bs-target="#viewPaymentModal{{ $payment->id }}">
                        View
                    </button>

                    <!-- Edit -->
                    <button class="btn btn-sm btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#editPaymentModal{{ $payment->id }}">
                        Edit
                    </button>

                    <!-- Delete -->
                    <form action="{{ route('payments.destroy', $payment->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure you want to delete this payment?')">
                            Delete
                        </button>
                    </form>

                    <!-- preview receipt-->
                     <a href="{{route('payments.receipt.preview', $payment->id)}}" 
                     class="btn btn-sm btn-info">
                        Preview Receipt
                    </a>

                    <!-- Download Receipt -->
                    <a href="{{ route('payments.receipt.download', $payment->id) }}" class="btn btn-sm btn-secondary">
                        Download Receipt
                    </a>
                </td>
            </tr>

            <!-- View Modal -->
            <div class="modal fade" id="viewPaymentModal{{ $payment->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">View Payment: {{ $payment->receipt_no }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>ID:</strong> {{ $payment->id }}</p>
                            <p><strong>Receipt No:</strong> {{ $payment->receipt_no }}</p>
                            <p><strong>Enrollment:</strong> {{ $payment->enrollment->enroll_no ?? 'N/A' }}</p>
                            <p><strong>Amount:</strong> {{ $payment->amount }}</p>
                            <p><strong>Payment Date:</strong> {{ $payment->payment_date }}</p>
                            <p><strong>Method:</strong> {{ $payment->method }}</p>
                            <p><strong>Created At:</strong> {{ $payment->created_at->format('d M, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div> 

            <!-- Edit Modal -->
            <div class="modal fade" id="editPaymentModal{{ $payment->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('payments.update', $payment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Payment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Receipt No</label>
                                    <input type="text" name="receipt_no" value="{{ $payment->receipt_no }}" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label>Enrollment</label>
                                    <select name="enrollment_id" class="form-control" required>
                                        @foreach($enrollments as $enrollment)
                                            <option value="{{ $enrollment->id }}" {{ $payment->enrollment_id == $enrollment->id ? 'selected' : '' }}>
                                                {{ $enrollment->enroll_no }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label>Amount</label>
                                    <input type="number" name="amount" value="{{ $payment->amount }}" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Payment Date</label>
                                    <input type="date" name="payment_date" value="{{ $payment->payment_date }}" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label>Method</label>
                                    <select name="method" class="form-control">
                                        <option value="Cash" {{ $payment->method == 'Cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="Card" {{ $payment->method == 'Card' ? 'selected' : '' }}>Card</option>
                                        <option value="Mobile Money" {{ $payment->method == 'Mobile Money' ? 'selected' : '' }}>Mobile Money</option>
                                        <option value="Bank Transfer" {{ $payment->method == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                    </select>
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
<div class="modal fade" id="createPaymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('payments.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Receipt No</label>
                        <input type="text" name="receipt_no" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Enrollment</label>
                        <select name="enrollment_id" class="form-control" required>
                            @foreach($enrollments as $enrollment)
                                <option value="{{ $enrollment->id }}">{{ $enrollment->enroll_no }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Amount</label>
                        <input type="number" name="amount" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Payment Date</label>
                        <input type="date" name="payment_date" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Method</label>
                        <select name="method" class="form-control">
                            <option value="Cash">Cash</option>
                            <option value="Card">Card</option>
                            <option value="Mobile Money">Mobile Money</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                        </select>
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