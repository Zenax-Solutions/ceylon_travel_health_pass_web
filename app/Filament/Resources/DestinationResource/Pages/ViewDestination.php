<?php

namespace App\Filament\Resources\DestinationResource\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\DestinationResource;

class ViewDestination extends ViewRecord
{
    protected static string $resource = DestinationResource::class;

    public function getHeaderActions(): array
    {
        return [EditAction::make()];
    }
}
