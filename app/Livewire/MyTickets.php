<?php

namespace App\Livewire;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Livewire\Component;

class MyTickets extends Component
{

    public $tickets;

    public function mount(Request $request)
    {
        $this->tickets = Ticket::where('booking_id', $request->id)->get();
    }

    public function render()
    {
        return view('livewire.my-tickets');
    }
}
