<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>receipt</title>
</head>
<body>
    <h2>Payment Receipt</h2>
    <p><strong>Receipt No:</strong> {{$payment->receipt_no}}</p>
    <p><strong>Student name:</strong> {{$payment->enrollment->student->name}}</p>
    <p><strong>Course Name:</strong> {{$payment->enrollment->batch->course->name}}</p>
    <p><strong>Batch:</strong> {{$payment->enrollment->batch->name}}</p>
    <p><strong>Amount:</strong> {{$payment->amount}}</p>
    <p><strong>Date:</strong> {{$payment->payment_date}}</p>

    <footer>
        <p>Thank you for your payment</p>
    </footer>
</body>
</html>