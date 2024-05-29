<?php

namespace App\Filament\Resources\EsimServiceResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\EsimServiceResource;

class ListEsimServices extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = EsimServiceResource::class;
}
