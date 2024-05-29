<?php

namespace App\Filament\Resources\BookingResource\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\BookingResource;

class ViewBooking extends ViewRecord
{
    protected static string $resource = BookingResource::class;

    public function getHeaderActions(): array
    {
        return [EditAction::make()];
    }
}
