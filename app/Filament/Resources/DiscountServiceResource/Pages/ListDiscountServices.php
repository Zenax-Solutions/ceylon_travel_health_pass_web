<?php

namespace App\Filament\Resources\DiscountServiceResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\DiscountServiceResource;

class ListDiscountServices extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = DiscountServiceResource::class;
}
