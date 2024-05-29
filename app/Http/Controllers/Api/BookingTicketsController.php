<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Http\Resources\TicketCollection;

class BookingTicketsController extends Controller
{
    public function index(Request $request, Booking $booking): TicketCollection
    {
        $this->authorize('view', $booking);

        $search = $request->get('search', '');

        $tickets = $booking
            ->tickets()
            ->search($search)
            ->latest()
            ->paginate();

        return new TicketCollection($tickets);
    }

    public function store(Request $request, Booking $booking): TicketResource
    {
        $this->authorize('create', Ticket::class);

        $validated = $request->validate([
            'ticket_id' => ['required', 'string'],
            'expiry_date' => ['required', 'date'],
            'status' => ['required', 'string'],
        ]);

        $ticket = $booking->tickets()->create($validated);

        return new TicketResource($ticket);
    }
}
