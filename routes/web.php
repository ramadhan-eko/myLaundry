<?php

use App\Http\Controllers\Admin\CucianItemController;
use App\Http\Controllers\Admin\ProdukServiceController;
use App\ProdukService;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', 'DashboardController@index')
            ->name('dashboard');

        Route::resource('produk-service', 'ProdukServiceController');
        Route::resource('laundry-card', 'LaundryCardController');
        Route::resource('customer', 'CustomerController');
        Route::resource('user-level', 'UserLevelController');
        Route::resource('cucian-item', 'CucianItemController')->except('create');
        Route::resource('promo', 'PromoController');
        Route::resource('payment', 'PaymentController')->except('create');

        // route buatan
        Route::get('/payment/create/{id}', 'PaymentController@create')->name('payment.create');
        Route::get('/laundry-card/detail/{id}', 'LaundryCardController@detail')->name('laundry-card.detail');
        Route::get('/cucian-item/create/{id}', 'CucianItemController@create')->name('cucian-item.create');
        Route::get('/laundry-card/diambil/{id}', 'LaundryCardController@diambil')->name('laundry-card.diambil');
        Route::get('/laundry-card/selesai/{id}', 'LaundryCardController@selesai')->name('laundry-card.selesai');
    });

Auth::routes();
