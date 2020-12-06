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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')
    ->namespace('Admin')
    ->group(function () {
        Route::get('/', 'DashboardController@index')
            ->name('dashboard');

        Route::resource('produk-service', 'ProdukServiceController');
        Route::resource('laundry-card', 'LaundryCardController');
        Route::resource('customer', 'CustomerController');
        Route::resource('user-level', 'UserLevelController');
        Route::resource('cucian-item', 'CucianItemController');
    });
