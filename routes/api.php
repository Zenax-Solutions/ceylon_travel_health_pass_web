<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AgentController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\EsimServiceController;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\Api\DiscountShopController;
use App\Http\Controllers\Api\BookingTicketsController;
use App\Http\Controllers\Api\DiscountServiceController;
use App\Http\Controllers\Api\PackageBookingsController;
use App\Http\Controllers\Api\CityDestinationsController;
use App\Http\Controllers\Api\CustomerBookingsController;
use App\Http\Controllers\Api\AgentEsimServicesController;
use App\Http\Controllers\Api\AgentDiscountShopsController;
use App\Http\Controllers\Api\AgentDiscountServicesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('agents', AgentController::class);

        // Agent Discount Shops
        Route::get('/agents/{agent}/discount-shops', [
            AgentDiscountShopsController::class,
            'index',
        ])->name('agents.discount-shops.index');
        Route::post('/agents/{agent}/discount-shops', [
            AgentDiscountShopsController::class,
            'store',
        ])->name('agents.discount-shops.store');

        // Agent Discount Services
        Route::get('/agents/{agent}/discount-services', [
            AgentDiscountServicesController::class,
            'index',
        ])->name('agents.discount-services.index');
        Route::post('/agents/{agent}/discount-services', [
            AgentDiscountServicesController::class,
            'store',
        ])->name('agents.discount-services.store');

        // Agent Esim Services
        Route::get('/agents/{agent}/esim-services', [
            AgentEsimServicesController::class,
            'index',
        ])->name('agents.esim-services.index');
        Route::post('/agents/{agent}/esim-services', [
            AgentEsimServicesController::class,
            'store',
        ])->name('agents.esim-services.store');

        Route::apiResource('discount-shops', DiscountShopController::class);

        Route::apiResource(
            'discount-services',
            DiscountServiceController::class
        );

        Route::apiResource('esim-services', EsimServiceController::class);

        Route::apiResource('cities', CityController::class);

        // City Destinations
        Route::get('/cities/{city}/destinations', [
            CityDestinationsController::class,
            'index',
        ])->name('cities.destinations.index');
        Route::post('/cities/{city}/destinations', [
            CityDestinationsController::class,
            'store',
        ])->name('cities.destinations.store');

        Route::apiResource('destinations', DestinationController::class);

        Route::apiResource('packages', PackageController::class);

        // Package Bookings
        Route::get('/packages/{package}/bookings', [
            PackageBookingsController::class,
            'index',
        ])->name('packages.bookings.index');
        Route::post('/packages/{package}/bookings', [
            PackageBookingsController::class,
            'store',
        ])->name('packages.bookings.store');

        Route::apiResource('customers', CustomerController::class);

        // Customer Bookings
        Route::get('/customers/{customer}/bookings', [
            CustomerBookingsController::class,
            'index',
        ])->name('customers.bookings.index');
        Route::post('/customers/{customer}/bookings', [
            CustomerBookingsController::class,
            'store',
        ])->name('customers.bookings.store');

        Route::apiResource('bookings', BookingController::class);

        // Booking Tickets
        Route::get('/bookings/{booking}/tickets', [
            BookingTicketsController::class,
            'index',
        ])->name('bookings.tickets.index');
        Route::post('/bookings/{booking}/tickets', [
            BookingTicketsController::class,
            'store',
        ])->name('bookings.tickets.store');

        Route::apiResource('tickets', TicketController::class);
    });
