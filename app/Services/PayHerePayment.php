<?php

namespace App\Services;

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
        $this->returnUrl = route('payment.info');
        $this->cancelUrl = route('payment.info');
        $this->notifyUrl = route('payment.info');
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

        // Create and submit the form
        return $this->createAndSubmitForm($data);
    }

    protected function generateHash($data)
    {
        $hashString = $this->merchantId . $data['order_id'] . $data['amount'] . $data['currency'] . strtoupper(md5($this->merchantSecret));
        return strtoupper(md5($hashString));
    }

    protected function createAndSubmitForm($data)
    {
        $form = '<form id="payhere_form" method="post" action="https://sandbox.payhere.lk/pay/checkout">';
        foreach ($data as $key => $value) {
            $form .= '<input type="hidden" name="' . $key . '" value="' . $value . '">';
        }
        $form .= '</form>';
        $form .= '<script type="text/javascript">document.getElementById("payhere_form").submit();</script>';

        return $form;
    }
}
