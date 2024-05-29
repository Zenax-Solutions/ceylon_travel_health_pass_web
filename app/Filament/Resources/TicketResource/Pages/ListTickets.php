<?php

namespace App\Filament\Resources\TicketResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\TicketResource;
use App\Filament\Traits\HasDescendingOrder;

class ListTickets extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = TicketResource::class;
}
