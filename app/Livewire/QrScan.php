<?php

namespace App\Livewire;

use App\Models\Ticket;
use Livewire\Component;

class QrScan extends Component
{

    public $qrCode;

    protected $listeners = ['scanQrCode'];

    public function scanQrCode($qrCode)
    {
        $this->qrCode = $qrCode;
    }


    public function render()
    {
        return view('livewire.qr-scan');
    }
}
