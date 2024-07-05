<?php

namespace App\Filament\Widgets;

use App\Models\Agent;
use App\Models\Customer;
use App\Models\Destination;
use App\Models\DiscountService;
use App\Models\DiscountShop;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getStats(): array
    {
        $countOfActiveAgents = Agent::where('status', 'publish')->count();
        $countOfPendingAgents = Agent::where('status', 'pending')->count();
        $countOfCustomers = Customer::where('status', 'active')->count();

        $activeDestinationsCout = Destination::where('status', 'publish')->count();
        $activeDiscountShopsCount = DiscountShop::where('status', 'publish')->count();
        $activeDiscountServicesCount = DiscountService::where('status', 'publish')->count();



        return [
            Stat::make('Active Agents', number_format($countOfActiveAgents))->description('Count of Active Agents')->descriptionIcon('heroicon-m-user-group')->color('success'),
            Stat::make('Pending Agents', number_format($countOfPendingAgents))->description('Count of Pending Agents')->descriptionIcon('heroicon-m-user-group')->color('danger'),
            Stat::make('Subscribers', number_format($countOfCustomers))->description('Total of Subscribe Customers')->descriptionIcon('heroicon-m-user-circle')->color('primary'),

            Stat::make('Active Destinations', number_format($activeDestinationsCout)),
            Stat::make('Active Discount Shops', number_format($activeDiscountShopsCount)),
            Stat::make('Active Discount Services', number_format($activeDiscountServicesCount)),
           
        ];
    }
}
