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

        // Validate QR code with database
        $record = Ticket::where('ticket_id', $this->qrCode)->firstOrNull();

        if ($record != null) {
            // Handle successful validation
            $this->dispatchBrowserEvent('qrCodeValidated', ['status' => 'valid', 'data' => $record]);
        } else {
            // Handle failed validation
            $this->dispatchBrowserEvent('qrCodeValidated', ['status' => 'invalid']);
        }
    }


    public function render()
    {
        return view('livewire.qr-scan');
    }
}
