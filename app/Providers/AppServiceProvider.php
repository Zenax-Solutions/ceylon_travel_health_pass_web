<?php

namespace App\Providers;

use App\Models\PointsHistory;
use App\View\Components\logo;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Gate;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Gate::define('viewPulse', function (User $user) {
            return $user->isSuperAdmin();
        });

        Blade::component('logo', logo::class);
    }
}
