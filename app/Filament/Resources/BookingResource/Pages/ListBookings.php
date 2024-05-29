<?php

namespace App\Filament\Resources\BookingResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Traits\HasDescendingOrder;
use App\Filament\Resources\BookingResource;

class ListBookings extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = BookingResource::class;
}
