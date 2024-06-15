<?php

namespace App\Livewire;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\Attributes\On;

class QrScan extends Component
{

    public $qrCode;


    #[On('scanQrCode')]
    public function scanQrCode($decodedText)
    {

        $this->qrCode = $decodedText;

        // Validate QR code with database
        $record = Ticket::where('ticket_id', $this->qrCode)->first();

        dd($record);

        if ($record == null) {
            $this->dispatch('qrCodeValidated', ['status' => 'invalid']);
        } else {
            if ($record != null) {
                // Handle successful validation
                $this->dispatch('qrCodeValidated', ['status' => 'valid', 'data' => $record]);
            } else {
                // Handle failed validation
                $this->dispatch('qrCodeValidated', ['status' => 'invalid']);
            }
        }
    }


    public function render()
    {
        return view('livewire.qr-scan');
    }
}
