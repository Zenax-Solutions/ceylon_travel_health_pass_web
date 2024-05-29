<?php

namespace App\Filament\Resources\TicketResource\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\TicketResource;

class ViewTicket extends ViewRecord
{
    protected static string $resource = TicketResource::class;

    public function getHeaderActions(): array
    {
        return [EditAction::make()];
    }
}
