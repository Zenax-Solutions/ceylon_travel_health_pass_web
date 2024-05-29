<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\CustomerResource;

class ViewCustomer extends ViewRecord
{
    protected static string $resource = CustomerResource::class;

    public function getHeaderActions(): array
    {
        return [EditAction::make()];
    }
}
