<?php

namespace App\Filament\Resources\DiscountShopResource\Pages;

use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\DiscountShopResource;

class ViewDiscountShop extends ViewRecord
{
    protected static string $resource = DiscountShopResource::class;

    public function getHeaderActions(): array
    {
        return [EditAction::make()];
    }
}
