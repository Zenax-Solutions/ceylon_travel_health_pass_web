<?php

namespace App\Filament\Resources\PackageResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\PackageResource;

class ListPackages extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = PackageResource::class;
}
