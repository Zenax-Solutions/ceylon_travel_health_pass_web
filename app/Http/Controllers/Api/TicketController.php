<?php

namespace App\Http\Controllers\Api;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Http\Resources\TicketCollection;
use App\Http\Requests\TicketStoreRequest;
use App\Http\Requests\TicketUpdateRequest;

class TicketController extends Controller
{
    public function index(Request $request): TicketCollection
    {
        $this->authorize('view-any', Ticket::class);

        $search = $request->get('search', '');

        $tickets = Ticket::search($search)
            ->latest()
            ->paginate();

        return new TicketCollection($tickets);
    }

    public function store(TicketStoreRequest $request): TicketResource
    {
        $this->authorize('create', Ticket::class);

        $validated = $request->validated();

        $ticket = Ticket::create($validated);

        return new TicketResource($ticket);
    }

    public function show(Request $request, Ticket $ticket): TicketResource
    {
        $this->authorize('view', $ticket);

        return new TicketResource($ticket);
    }

    public function update(
        TicketUpdateRequest $request,
        Ticket $ticket
    ): TicketResource {
        $this->authorize('update', $ticket);

        $validated = $request->validated();

        $ticket->update($validated);

        return new TicketResource($ticket);
    }

    public function destroy(Request $request, Ticket $ticket): Response
    {
        $this->authorize('delete', $ticket);

        $ticket->delete();

        return response()->noContent();
    }
}
