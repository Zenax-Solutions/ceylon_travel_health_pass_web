<?php

namespace App\Filament\Resources\AgentResource\Pages;

use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\AgentResource;
use App\Filament\Traits\HasDescendingOrder;
use App\Models\Agent;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListAgents extends ListRecords
{
    use HasDescendingOrder;

    protected static string $resource = AgentResource::class;



    public function getTabs(): array
    {
        return [

            'Tourism Agent' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'tour_agent'))
                ->badge(number_format(Agent::where('type', 'tour_agent')->count()))->icon('heroicon-o-user-group')
                ->badgeColor('primary'),

            'Discount Agent' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'discount_agent'))
                ->badge(number_format(Agent::where('type', 'discount_agent')->count()))->icon('heroicon-o-user-group')
                ->badgeColor('primary'),

            'Service Agent' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'service_agent'))
                ->badge(number_format(Agent::where('type', 'service_agent')->count()))->icon('heroicon-o-user-group')
                ->badgeColor('primary'),

            'Esim Agent' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('type', 'esim_agent'))
                ->badge(number_format(Agent::where('type', 'esim_agent')->count()))->icon('heroicon-o-user-group')
                ->badgeColor('primary'),


        ];
    }
}
