<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\EsimServiceController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\DiscountShopController;
use App\Http\Controllers\DiscountServiceController;
use Illuminate\Support\Facades\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Home
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'home');
    Route::get('/package/{id}', 'package')->name('package');
    Route::get('/shops', 'shops')->name('shops');
    Route::get('/services', 'services')->name('services');
    Route::get('/payment/info', 'thankYouPage')->name('payment.info');
});


//Customers

Route::middleware('customer_auth')->group(function () {
    Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/customer/register', [CustomerController::class, 'registerView'])->name('customer.register');
    Route::get('/customer/login', [CustomerController::class, 'loginView'])->name('customer.login');
    Route::get('/customer/my-profile', [CustomerController::class, 'myProfile'])->name('customer.profile');
    Route::get('/customer/{id?}/my-tickets', [CustomerController::class, 'myTickets'])->name('customer.tickets');
    Route::post('customer/profile/reset-password', [CustomerController::class, 'resetPassword'])->name('customer.profile.resetPassword');
    Route::delete('customer/profile/delete', [CustomerController::class, 'deleteAccount'])->name('customer.profile.deleteAccount');
});

Route::controller(CustomerController::class)->group(function () {
    Route::post('/customer/login/validate/{redirect?}', 'loginCustomer')->name('customer.login.validate');
    Route::post('/customer/register/submit', 'registerCustomer')->name('customer.register.submit');
    Route::get('/customer/logout', 'logout')->name('customer.logout');
});



//Agents

Route::middleware('agent_auth')->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'dashboard'])->name('agent.dashboard');
    Route::get('/agent/dashboard/qrscan', [AgentController::class, 'qrscan'])->name('agent.qrscan');
    Route::get('/agent/dashboard/records', [AgentController::class, 'records'])->name('agent.records');
    Route::get('/agent/register', [AgentController::class, 'registerView'])->name('agent.register');
    Route::get('/agent/login', [AgentController::class, 'loginView'])->name('agent.login');
});


Route::controller(AgentController::class)->group(function () {
    Route::post('/agent/login/validate', 'loginAgent')->name('agent.login.validate');
    Route::post('/agent/register/submit', 'registerAgent')->name('agent.register.submit');
    Route::get('/agent/logout', 'logout')->name('agent.logout');
});
