<?php

namespace App\Services;

use App\Models\Booking;
use Illuminate\Support\Facades\Log;

class PayHerePayment
{
    protected $merchantId;
    protected $merchantSecret;
    protected $returnUrl;
    protected $cancelUrl;
    protected $notifyUrl;

    protected $qrCodeGenarate;

    public function __construct()
    {

        $this->merchantId = config('app.payhere_merchant_id'); // Use config() instead of env()
        $this->merchantSecret = config('app.payhere_merchant_secret'); // Use config() instead of env()
        $this->returnUrl = config('app.url') . '/api/payment/return'; // Use config() instead of env()
        $this->cancelUrl = config('app.url') . '/api/payment/cancel'; // Use config() instead of env()
        $this->notifyUrl = config('app.url') . '/api/payment/notify'; // Use config() instead of env()

        $genarateQrCodes = new GenarateQrCodes;

        $this->qrCodeGenarate = $genarateQrCodes;
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
    }

    protected function generateHash($data)
    {
        $hashString = $this->merchantId . $data['order_id'] . $data['amount'] . $data['currency'] . strtoupper(md5($this->merchantSecret));
        return strtoupper(md5($hashString));
    }

    public function handleNotification($request)
    {

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

            $booking = Booking::find($orderId);

            $booking->update(['payment_status' => 'paid']);

            if ($booking->agent_id != null) {

                $regionality = session('agent_booking_ticket_regionality');

                $this->qrCodeGenarate->genarate($booking, $booking, $booking->agent, $regionality);
            } else {
                $this->qrCodeGenarate->genarate($booking, $booking, $booking->customer, $booking->customer->regionality);
            }


            return response('Payment verified', 200);
        } elseif ($localMd5sig === $md5sig && $statusCode == -1) {

            Booking::find($orderId)->update(['payment_status' => 'canceled']);

            return response('Payment canceled', 400);
        } elseif ($localMd5sig === $md5sig && $statusCode == -2) {

            Booking::find($orderId)->update(['payment_status' => 'declined']);

            return response('Payment declined', 400);
        } elseif ($localMd5sig === $md5sig && $statusCode == 0) {

            Booking::find($orderId)->update(['payment_status' => 'pending']);

            return response('Payment pending', 400);
        }

        return response('Payment verification failed', 400);
    }
}
