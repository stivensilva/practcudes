<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SorteoController;
use App\Http\Controllers\BoletaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    if (Auth::check())
        return redirect('/home'); 
        
    return view('login');
});

Route::get('/login', function () {
    if (Auth::check())
        return redirect('/home'); 
        
    return view('login');
})->name('login');

Route::post('/check', [LoginController::class, 'check']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/forgot-password', [LoginController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [LoginController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [LoginController::class, 'reset'])->name('password.update');








Route::middleware(['auth'])->group(function () {
    
    Route::get('/home', [LoginController::class, 'dashboard']);
    // Route::get('/coupons-data', [LoginController::class, 'couponsData']);
    
    Route::view('/profile', 'profile');
    Route::post('/profile', [LoginController::class, 'profile']);
    Route::post('/avatar', [LoginController::class, 'avatar']);

    


    Route::middleware(['admin'])->group(function () {
        Route::resource('/sorteos', SorteoController::class);
        Route::resource('/boletas', BoletaController::class);
        Route::resource('/clientes', ClienteController::class);
        Route::resource('/usuarios', UsuarioController::class);
        
        
      
        // Route::resource('/products', ProductController::class);
        // Route::get('/products/bestseller/{id}', [ProductController::class, 'bestseller']);
        // Route::resource('/coupons', CouponController::class)->except(['show']);
        // Route::resource('/customer-coupons', CustomerCouponsController::class);
        // Route::resource('/customers', CustomerController::class);
        // Route::resource('/products-of-the-month', ProductsOfTheMonthController::class);
        // Route::resource('/users', UserController::class);
        // Route::resource('/catering-categories', CateringCategoryController::class);
        // Route::resource('/catering', CateringController::class);
    });
    
    // Route::get('/coupons', [CouponController::class, 'index']);
    // Route::get('/coupons/{id}', [CouponController::class, 'show']);
    // Route::get('/customer-coupons', [CustomerCouponsController::class, 'index']);
    
    // Route::middleware(['supervisor'])->group(function () {
        
    // });    
    
});