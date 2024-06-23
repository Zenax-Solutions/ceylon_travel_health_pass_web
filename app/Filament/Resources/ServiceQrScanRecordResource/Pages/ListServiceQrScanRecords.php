<?php

namespace App\Filament\Resources\ServiceQrScanRecordResource\Pages;

use App\Filament\Resources\ServiceQrScanRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceQrScanRecords extends ListRecords
{
    protected static string $resource = ServiceQrScanRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
