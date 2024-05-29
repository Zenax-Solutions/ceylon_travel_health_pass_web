<?php

namespace App\Filament\Resources\PackageResource\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\PackageResource;

class ViewPackage extends ViewRecord
{
    protected static string $resource = PackageResource::class;

    public function getHeaderActions(): array
    {
        return [EditAction::make()];
    }
}
