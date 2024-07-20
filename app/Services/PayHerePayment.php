<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayHerePayment
{
    protected $merchantId;
    protected $merchantSecret;
    protected $returnUrl;
    protected $cancelUrl;
    protected $notifyUrl;

    public function __construct()
    {
        $this->merchantId = env('PAYHERE_MERCHANT_ID'); // Add your PayHere Merchant ID to the .env file
        $this->merchantSecret = env('PAYHERE_MERCHANT_SECRET'); // Add your PayHere Merchant Secret to the .env file
        $this->returnUrl = route('payment.return');
        $this->cancelUrl = route('payment.cancel');
        $this->notifyUrl = route('payment.notify');
    }

    public function execute($booking)
    {
        $data = [
            'merchant_id' => $this->merchantId,
            'return_url' => $this->returnUrl,
            'cancel_url' => $this->cancelUrl,
            'notify_url' => $this->notifyUrl,
            'first_name' => $booking->customer->first_name,
            'last_name' => $booking->customer->last_name,
            'email' => $booking->customer->email,
            'phone' => $booking->customer->contact_no,
            'address' => 'colombo',
            'city' => 'colombo',
            'country' => 'Sri Lanka',
            'order_id' => $booking->id,
            'items' => $booking->package->main_title,
            'currency' => 'USD',
            'amount' => number_format($booking->total, 2, '.', ''),
        ];

        $data['hash'] = $this->generateHash($data);

        return $data;

        // Return a view or redirect with the form data to submit to PayHere
        //return view('payment.payhere.checkout', compact('data'));
    }

    protected function generateHash($data)
    {
        $hashString = $this->merchantId . $data['order_id'] . $data['amount'] . $data['currency'] . strtoupper(md5($this->merchantSecret));
        return strtoupper(md5($hashString));
    }

    public function handleNotification(Request $request)
    {
        Log::info($request);

        $merchantId = $request->input('merchant_id');
        $orderId = $request->input('order_id');
        $payhereAmount = $request->input('payhere_amount');
        $payhereCurrency = $request->input('payhere_currency');
        $statusCode = $request->input('status_code');
        $md5sig = $request->input('md5sig');

        $localMd5sig = strtoupper(
            md5(
                $merchantId .
                    $orderId .
                    $payhereAmount .
                    $payhereCurrency .
                    $statusCode .
                    strtoupper(md5($this->merchantSecret))
            )
        );

        if ($localMd5sig === $md5sig && $statusCode == 2) {
            // TODO: Update your database as payment success

            Booking::find($orderId)->update(['status' => 'paid']);

            return response('Payment verified', 200);
        }

        return response('Payment verification failed', 400);
    }
}
