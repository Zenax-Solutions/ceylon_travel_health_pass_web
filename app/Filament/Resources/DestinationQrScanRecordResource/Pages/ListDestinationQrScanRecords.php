<?php

namespace App\Filament\Resources\DestinationQrScanRecordResource\Pages;

use App\Filament\Resources\DestinationQrScanRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDestinationQrScanRecords extends ListRecords
{
    protected static string $resource = DestinationQrScanRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
