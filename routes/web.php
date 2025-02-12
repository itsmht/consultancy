<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthGuest;
use App\Http\Middleware\AuthUser;
use App\Http\Middleware\PreventBack;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

//Auth Routes
Route::get('/login', [AdminController::class, 'login'])->name('login');
Route::post('/login.submit', [AdminController::class, 'loginSubmit'])->name('login.submit');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

//Admin Routes
Route::group(['middleware' => [AuthGuest::class, AuthUser::class, PreventBack::class]], function () {
    Route::get('/adminDashboard', [AdminController::class, 'dashboard'])->name('adminDashboard');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/addCategory', [AdminController::class, 'addCategory'])->name('addCategory');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/addProduct', [AdminController::class, 'addProduct'])->name('addProduct');
});