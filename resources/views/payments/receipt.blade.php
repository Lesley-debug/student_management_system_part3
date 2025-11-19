<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Receipt - {{ $payment->receipt_no }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; }
        .header p { margin: 0; font-size: 14px; }
        .details { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .details th, .details td { border: 1px solid #ddd; padding: 8px; }
        .details th { background-color: #f8f9fa; text-align: left; }
        .footer { margin-top: 30px; text-align: center; font-size: 12px; color: #555; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Payment Receipt</h1>
        <p>Receipt No: {{ $payment->receipt_no }}</p>
        <p>Date: {{ \Carbon\Carbon::parse($payment->payment_date)->format('d M, Y') }}</p>
    </div>

    <table class="details">
        <tr>
            <th>Student Name</th>
            <td>{{ $payment->enrollment->student->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Enrollment No</th>
            <td>{{ $payment->enrollment->enroll_no ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Course & Batch</th>
            <td>{{ $payment->enrollment->batch->course->name ?? 'N/A' }} - {{ $payment->enrollment->batch->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Payment Amount</th>
            <td>${{ number_format($payment->amount, 2) }}</td>
        </tr>
        <tr>
            <th>Payment Method</th>
            <td>{{ $payment->method ?? 'N/A' }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>Thank you for your payment!</p>
        <p>Powered by Your Student Management System</p>
        <p>This receipt is automatically generated and valid without signature.</p>
    </div>

</body>
</html>
