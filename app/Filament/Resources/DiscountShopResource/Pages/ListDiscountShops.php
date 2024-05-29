<?php

namespace App\Filament\Resources\DiscountShopResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\DiscountShopResource;

class ListDiscountShops extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = DiscountShopResource::class;
}
