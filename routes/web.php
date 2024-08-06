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
use App\Http\Controllers\PaymentController;
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
    Route::get('/blogs', 'blogs')->name('blogs');
    Route::get('/blogs/{slug?}', 'singleBlog')->name('blogs.page');
    Route::get('/review-us', 'review')->name('review');
    Route::get('/payment/info', 'thankYouPage')->name('payment.info');
});


Route::view('/privacy-policy', 'pages.home.pages.privacy-policy')->name('privacy-policy');
Route::view('/terms-and-conditions', 'pages.home.pages.terms-and-conditions')->name('terms-and-conditions');
Route::view('/refund-policy', 'pages.home.pages.refund-policy')->name('refund-policy');

///////////////////////////////


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
    Route::get('/agent/dashboard/sevices', [AgentController::class, 'services'])->name('agent.services');
    Route::get('/agent/dashboard/my-profile', [AgentController::class, 'myProfile'])->name('agent.profile');
    Route::get('/agent/dashboard/packages', [AgentController::class, 'packages'])->name('agent.packages');
    Route::get('/agent/dashboard/packages/{id}/booking', [AgentController::class, 'booking'])->name('agent.booking');
    Route::get('/agent/dashboard/{id?}/my-tickets', [AgentController::class, 'myTickets'])->name('agent.tickets');
    Route::post('agent/profile/reset-password', [AgentController::class, 'resetPassword'])->name('agent.profile.resetPassword');
    Route::post('agent/profile/image-update', [AgentController::class, 'imageUpdate'])->name('agent.profile.imageUpdate');
    Route::get('/agent/register', [AgentController::class, 'registerView'])->name('agent.register');
    Route::get('/agent/login', [AgentController::class, 'loginView'])->name('agent.login');
});
Route::controller(AgentController::class)->group(function () {
    Route::post('/agent/login/validate', 'loginAgent')->name('agent.login.validate');
    Route::post('/agent/register/submit', 'registerAgent')->name('agent.register.submit');
    Route::get('/agent/logout', 'logout')->name('agent.logout');
});



// Destination Portal
Route::middleware('destination_code_check')->group(function () {
    Route::get('/destination/dashboard', [DestinationController::class, 'dashboard'])->name('destination.dashboard');
    Route::get('/destination/dashboard/qrscan', [DestinationController::class, 'qrscan'])->name('destination.qrscan');
    Route::get('/destination/dashboard/records', [DestinationController::class, 'records'])->name('destination.records');
    Route::get('/destination/login', [DestinationController::class, 'loginView'])->name('destination.login');
});

Route::controller(DestinationController::class)->group(function () {
    Route::post('/destination/login/validate', 'loginDestination')->name('destination.login.validate');
    Route::get('/destination/logout', 'logout')->name('destination.logout');
});



//PayHere Routes
Route::get('/payment/process', [PaymentController::class, 'process'])->name('payment.process');

//Mobile App Home View

Route::view('/app/mobile/home', 'mobile.home')->name('mobile.home');
