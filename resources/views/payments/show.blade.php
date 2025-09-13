<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student management system</title>
</head>
<body>
  <p>View a payment</p>

  <a href="{{route('payments.receipt', $payment->id)}}" class="btn btn-primary">
    Print Receipt
  </a>

</body>
</html>