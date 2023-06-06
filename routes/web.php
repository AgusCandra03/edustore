<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
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
    return view('/auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('test_spatie', [App\Http\Controllers\Auth\RegisterController::class, 'test_spatie']);
Route::get('/edit-profile', [App\Http\Controllers\Auth\RegisterController::class, 'editProfile'])->name('edit-profile');
Route::post('/edit-profile', [App\Http\Controllers\Auth\RegisterController::class, 'updateProfile'])->name('update-profile');
Route::get('/settings', [App\Http\Controllers\SettingController::class, 'index'])->name('settings');
Route::post('/settings', [App\Http\Controllers\SettingController::class, 'update'])->name('update');
Route::get('/sale/nota/{id}', [App\Http\Controllers\SaleDetailController::class, 'nota'])->name('nota');

Route::resource('/products', App\Http\Controllers\ProductController::class);
Route::resource('/suppliers', App\Http\Controllers\SupplierController::class);
Route::resource('/members', App\Http\Controllers\MemberController::class);
Route::resource('/categories', App\Http\Controllers\CategoryController::class);
Route::resource('/registers', App\Http\Controllers\Auth\RegisterController::class);
Route::resource('/sales', App\Http\Controllers\SalesController::class);
Route::resource('/sale_details', App\Http\Controllers\SaleDetailController::class);
Route::resource('/stocks', App\Http\Controllers\StockController::class);

Route::get('/api/categories', [App\Http\Controllers\CategoryController::class, 'api']);
Route::get('/api/members', [App\Http\Controllers\MemberController::class, 'api']);
Route::get('/api/suppliers', [App\Http\Controllers\SupplierController::class, 'api']);
Route::get('/api/products', [App\Http\Controllers\ProductController::class, 'api']);
Route::get('/api/registers', [App\Http\Controllers\Auth\RegisterController::class, 'api']);
Route::get('/api/sales', [App\Http\Controllers\SalesController::class, 'api']);
Route::get('/api/sale_details', [App\Http\Controllers\SaleDetailController::class, 'api']);
Route::get('/api/stocks', [App\Http\Controllers\StockController::class, 'api']);
Route::get('/api/settings', [App\Http\Controllers\SettingController::class, 'api']);

Route::get('/product/list', [ProductController::class, 'list']);
Route::get('/member/list', [MemberController::class, 'list']);
