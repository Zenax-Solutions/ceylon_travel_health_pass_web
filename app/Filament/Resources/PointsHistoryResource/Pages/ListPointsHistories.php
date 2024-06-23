<?php

namespace App\Filament\Resources\PointsHistoryResource\Pages;

use App\Filament\Resources\PointsHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPointsHistories extends ListRecords
{
    protected static string $resource = PointsHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
