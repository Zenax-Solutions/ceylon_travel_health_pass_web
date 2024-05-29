<?php

namespace App\Filament\Resources\EsimServiceResource\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\EsimServiceResource;

class ViewEsimService extends ViewRecord
{
    protected static string $resource = EsimServiceResource::class;

    public function getHeaderActions(): array
    {
        return [EditAction::make()];
    }
}
