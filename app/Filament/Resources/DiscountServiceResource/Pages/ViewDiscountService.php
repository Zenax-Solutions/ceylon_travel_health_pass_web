<?php

namespace App\Filament\Resources\DiscountServiceResource\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\DiscountServiceResource;

class ViewDiscountService extends ViewRecord
{
    protected static string $resource = DiscountServiceResource::class;

    public function getHeaderActions(): array
    {
        return [EditAction::make()];
    }
}
