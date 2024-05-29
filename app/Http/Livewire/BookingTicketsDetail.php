<?php

namespace App\Http\Livewire;

use App\Models\Ticket;
use Livewire\Component;
use App\Models\Booking;
use Illuminate\View\View;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookingTicketsDetail extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    public Booking $booking;
    public Ticket $ticket;
    public $ticketExpiryDate;

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Ticket';

    protected $rules = [
        'ticket.ticket_id' => ['required', 'string'],
        'ticketExpiryDate' => ['required', 'date'],
        'ticket.status' => ['required', 'string'],
    ];

    public function mount(Booking $booking): void
    {
        $this->booking = $booking;
        $this->resetTicketData();
    }

    public function resetTicketData(): void
    {
        $this->ticket = new Ticket();

        $this->ticketExpiryDate = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newTicket(): void
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.booking_tickets.new_title');
        $this->resetTicketData();

        $this->showModal();
    }

    public function editTicket(Ticket $ticket): void
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.booking_tickets.edit_title');
        $this->ticket = $ticket;

        $this->ticketExpiryDate = optional($this->ticket->expiry_date)->format(
            'Y-m-d'
        );

        $this->dispatchBrowserEvent('refresh');

        $this->showModal();
    }

    public function showModal(): void
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal(): void
    {
        $this->showingModal = false;
    }

    public function save(): void
    {
        $this->validate();

        if (!$this->ticket->booking_id) {
            $this->authorize('create', Ticket::class);

            $this->ticket->booking_id = $this->booking->id;
        } else {
            $this->authorize('update', $this->ticket);
        }

        $this->ticket->expiry_date = \Carbon\Carbon::make(
            $this->ticketExpiryDate
        );

        $this->ticket->save();

        $this->hideModal();
    }

    public function destroySelected(): void
    {
        $this->authorize('delete-any', Ticket::class);

        Ticket::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetTicketData();
    }

    public function toggleFullSelection(): void
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->booking->tickets as $ticket) {
            array_push($this->selected, $ticket->id);
        }
    }

    public function render(): View
    {
        return view('livewire.booking-tickets-detail', [
            'tickets' => $this->booking->tickets()->paginate(20),
        ]);
    }
}
