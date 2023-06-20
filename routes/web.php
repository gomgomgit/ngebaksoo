<?php

use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthClientController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/choose-type');
});

// Client section
Route::get('/sign-in',[AuthClientController::class, 'signin'])->name('client.signin');
Route::post('/sign-in-process',[AuthClientController::class, 'signinProcess'])->name('client.signin.process');
Route::get('/sign-up',[AuthClientController::class, 'signup'])->name('client.signup');
Route::post('/sign-up-process',[AuthClientController::class, 'signupProcess'])->name('client.signup.process');

Route::get('/logout',[AuthClientController::class, 'logout'])->name('client.logout');


Route::get('/choose-type',[ClientController::class, 'type'])->name('client.type');
Route::get('/choose-menu/{id}',[ClientController::class, 'menu'])->name('client.menu');

Route::middleware('auth:customer')->group(function () {
    Route::post('/add-to-cart',[ClientController::class, 'addCart'])->name('client.add.cart');
    Route::post('/edit-cart',[ClientController::class, 'editCart'])->name('client.edit.cart');
    Route::post('/delete-cart',[ClientController::class, 'deleteCart'])->name('client.delete.cart');

    Route::get('/history',[ClientController::class, 'history'])->name('client.history');
    Route::get('/cart',[ClientController::class, 'cart'])->name('client.cart');
    Route::post('/checkout',[ClientController::class, 'checkout'])->name('client.checkout');
    Route::get('/success',[ClientController::class, 'success'])->name('client.succeess');
});


// Admin section
Route::get('/admin/sign-in',[AuthAdminController::class, 'signin'])->name('admin.signin');
Route::post('/admin/sign-in-process',[AuthAdminController::class, 'signinProcess'])->name('admin.signin.process');

Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/logout',[AuthAdminController::class, 'logout'])->name('admin.logout');

    Route::get('/admin',[DashboardController::class, 'index'])->name('dashboard');

    Route::get('/admin/type',[TypeController::class, 'index'])->name('type');
    Route::post('/admin/type/store',[TypeController::class, 'store'])->name('type.store');
    Route::get('/admin/type/{id}',[TypeController::class, 'detail'])->name('type.detail');
    Route::post('/admin/type/update/{id}',[TypeController::class, 'update'])->name('type.update');
    Route::delete('/admin/type/delete/{id}',[TypeController::class, 'delete'])->name('type.delete');

    Route::get('/admin/type/{id}/create-menu',[TypeController::class, 'createMenu'])->name('type.create.menu');
    Route::post('/admin/type/store-menu',[TypeController::class, 'storeMenu'])->name('type.store.menu');
    Route::get('/admin/type/edit-menu/{id}',[TypeController::class, 'editMenu'])->name('type.edit.menu');
    Route::put('/admin/type/update-menu/{id}',[TypeController::class, 'updateMenu'])->name('type.update.menu');
    Route::get('/admin/type/change-status-menu/{id}',[TypeController::class, 'changeStatusMenu'])->name('type.change.status.menu');
    Route::delete('/admin/type/delete-menu/{id}',[TypeController::class, 'deleteMenu'])->name('type.delete.menu');

    Route::get('/admin/order',[OrderController::class, 'index'])->name('order');
    Route::post('/admin/order/done/{id}',[OrderController::class, 'done'])->name('order.done');
    Route::post('/admin/order/cancel/{id}',[OrderController::class, 'cancel'])->name('order.cancel');

    Route::get('/admin/history',[OrderController::class, 'history'])->name('history');

    Route::get('/admin/customer',[CustomerController::class, 'index'])->name('customer');

    Route::get('/admin/report',[ReportController::class, 'index'])->name('report');

    Route::get('/admin/user',[UserController::class, 'index'])->name('user');
    Route::post('/admin/user/store',[UserController::class, 'store'])->name('user.store');
    Route::post('/admin/user/update/{id}',[UserController::class, 'update'])->name('user.update');
    Route::delete('/admin/user/delete/{id}',[UserController::class, 'delete'])->name('user.delete');
});

