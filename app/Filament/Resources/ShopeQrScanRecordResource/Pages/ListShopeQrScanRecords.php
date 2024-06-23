<?php

namespace App\Filament\Resources\ShopeQrScanRecordResource\Pages;

use App\Filament\Resources\ShopeQrScanRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShopeQrScanRecords extends ListRecords
{
    protected static string $resource = ShopeQrScanRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
