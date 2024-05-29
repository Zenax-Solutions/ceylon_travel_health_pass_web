<?php

namespace App\Filament\Resources\BookingResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\BookingResource;

class CreateBooking extends CreateRecord
{
    protected static string $resource = BookingResource::class;
}
