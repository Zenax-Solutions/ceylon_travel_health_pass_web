<?php

namespace App\Filament\Resources\ServiceQrScanRecordResource\Pages;

use App\Filament\Resources\ServiceQrScanRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditServiceQrScanRecord extends EditRecord
{
    protected static string $resource = ServiceQrScanRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
