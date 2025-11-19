<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Student;

class PaymentController extends Controller
{
    // list all payments
    public function index()
    {
        $payments = Payment::with(['enrollment.student', 'enrollment.batch.course'])->get();

        // provide enrollments for the edit row select
        $enrollments = Enrollment::with(['student','batch.course'])->get();
        return view('payments.index', compact('payments', 'enrollments'));
    }

    // creating a new payment
    public function create()
    {
        $enrollments = Enrollment::with('student', 'batch.course')->get();
        return view('payments.create', compact('enrollments'));
    }

    //store  newly creatted payments in storage
public function store(Request $request)
{
    $validated = $request->validate([
        'enrollment_id' => 'required|exists:enrollments,id',
        'amount' => 'required|numeric|min:0',
        'payment_date' => 'required|date',
        'method' => 'nullable|string|max:50',
    ]);

    // ✅ Auto-generate receipt number (always new and unique)
    $year = date('Y');
    $lastPayment = Payment::whereYear('created_at', $year)->orderBy('id', 'desc')->first();

    $nextNumber = 1;
    if ($lastPayment && preg_match('/RCPT\d{4}-(\d+)/', $lastPayment->receipt_no, $matches)) {
        $nextNumber = intval($matches[1]) + 1;
    }

    $validated['receipt_no'] = 'RCPT' . $year . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

    Payment::create($validated);

    return redirect()->route('payments.index')->with('success', 'Payment created successfully');
}



    // display the payment
    public function show(Payment $payment)
    {
        $payment->load(['enrollment.student', 'enrollment.batch.course']);
        return view('payments.show', compact('payment'));
    }


    public function previewReceipt($id)
    {
        $payment = Payment::with('enrollment.student', 'enrollment.batch')->findOrFail($id);

        $pdf = Pdf::loadView('payments.receipt', compact('payment'));

        // Opens inside browser (inline mode)
        return $pdf->stream('receipt_'.$payment->receipt_no.'.pdf');
    }

    public function downloadReceipt($id)
    {
        $payment = Payment::with('enrollment.student', 'enrollment.batch')->findOrFail($id);

        $pdf = Pdf::loadView('payments.receipt', compact('payment'));

        // Forces download
        return $pdf->download('receipt_'.$payment->receipt_no.'.pdf');
    }

    //editing the secified payment
    public function edit(Payment $payment)
    {
        $enrollments = Enrollment::with(['student', 'batch.course'])->get();
        return view('payments.edit', compact('payment', 'enrollments'));
    }

    //update the payment method
public function update(Request $request, Payment $payment)
{
    $validated = $request->validate([
        'enrollment_id' => 'required|exists:enrollments,id',
        'amount' => 'required|numeric|min:0',
        'payment_date' => 'required|date',
        'method' => 'nullable|string|max:50',
    ]);

    // ✅ Auto-generate a receipt number if missing
    if (empty($payment->receipt_no)) {
        $year = date('Y');
        $lastPayment = Payment::whereYear('created_at', $year)->orderBy('id', 'desc')->first();

        $nextNumber = 1;
        if ($lastPayment && preg_match('/RCPT\d{4}-(\d+)/', $lastPayment->receipt_no, $matches)) {
            $nextNumber = intval($matches[1]) + 1;
        }

        $validated['receipt_no'] = 'RCPT' . $year . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    $payment->update($validated);

    return redirect()->route('payments.index')->with('success', 'Payment updated successfully');
}



    public function destroy(Payment $payment)
    {
        $payment ->delete();
        return redirect()->route('payments.index')->with('successs', 'payment deleted successfully');
    }
}
 