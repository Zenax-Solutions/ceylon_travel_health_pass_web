<?php

namespace App\Filament\Resources\AgentResource\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\AgentResource;

class ViewAgent extends ViewRecord
{
    protected static string $resource = AgentResource::class;

    public function getHeaderActions(): array
    {
        return [EditAction::make()];
    }
}
