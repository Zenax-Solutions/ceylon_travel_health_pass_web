<?php

namespace App\Filament\Resources\AgentResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\AgentResource;
use App\Filament\Traits\HasDescendingOrder;

class ListAgents extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = AgentResource::class;
}
