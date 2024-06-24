<?php

namespace App\Livewire;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class MyTickets extends Component
{

    public $tickets;

    public function mount(Request $request, $agent_mode = null)
    {
        if ($agent_mode == 'true') {

            if (Session::has('auth_agent')) {

                $this->tickets = Ticket::where('booking_id', $request->id)->get();
            } else {
                $this->redirectRoute('agent.login');
            }
        } else {
            if (Session::has('auth_customer')) {

                $this->tickets = Ticket::where('booking_id', $request->id)->get();
            } else {
                $this->redirectRoute('customer.login');
            }
        }
    }

    public function render()
    {
        return view('livewire.my-tickets');
    }
}
