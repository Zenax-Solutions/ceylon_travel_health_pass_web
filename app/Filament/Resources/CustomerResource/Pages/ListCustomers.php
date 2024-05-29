<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\CustomerResource;

class ListCustomers extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = CustomerResource::class;
}
