<?php

namespace App\Filament\Resources\CityResource\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\CityResource;

class ViewCity extends ViewRecord
{
    protected static string $resource = CityResource::class;

    public function getHeaderActions(): array
    {
        return [EditAction::make()];
    }
}
