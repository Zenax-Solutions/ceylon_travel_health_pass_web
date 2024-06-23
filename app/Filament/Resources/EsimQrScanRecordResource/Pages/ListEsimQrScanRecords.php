<?php

namespace App\Filament\Resources\EsimQrScanRecordResource\Pages;

use App\Filament\Resources\EsimQrScanRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEsimQrScanRecords extends ListRecords
{
    protected static string $resource = EsimQrScanRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
