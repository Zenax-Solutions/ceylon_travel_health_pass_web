<?php

namespace App\Http\Controllers;

use App\Services\PayHerePayment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $payHerePayment;

    public function __construct(PayHerePayment $payHerePayment)
    {
        $this->payHerePayment = $payHerePayment;
    }

    public function process(Request $request)
    {
        // Retrieve payment data from the session
        $paymentData = session('paymentData');

        if (!$paymentData) {
            // Handle the case where there is no payment data in the session
            return redirect('/');
        }

        return view('payment.payhere.checkout', compact('paymentData'));
    }

    public function handleNotify(Request $request)
    {
        return $this->payHerePayment->handleNotification($request);
    }

    public function handleReturn(Request $request)
    {
        return $this->payHerePayment->handleNotification($request);
    }

    public function handleCancel(Request $request)
    {
        // Handle cancel URL logic
    }
}
