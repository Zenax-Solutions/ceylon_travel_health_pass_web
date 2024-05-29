<?php

namespace App\Filament\Resources\DestinationResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\DestinationResource;

class ListDestinations extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = DestinationResource::class;
}
