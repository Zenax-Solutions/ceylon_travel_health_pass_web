<?php

namespace App\Filament\Resources\EsimQrScanRecordResource\Pages;

use App\Filament\Resources\EsimQrScanRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEsimQrScanRecord extends EditRecord
{
    protected static string $resource = EsimQrScanRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
