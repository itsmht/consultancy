<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthGuest;
use App\Http\Middleware\AuthUser;
use App\Http\Middleware\PreventBack;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TestimonialController;

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
    Route::get('/banners', [BannerController::class, 'banners'])->name('banners');
    Route::get('getBanners', [BannerController::class, 'getBanners'])->name('getBanners');
    Route::post('createBanner', [BannerController::class, 'createBanner'])->name('createBanner');
    Route::post('/update-banner/{id}', [BannerController::class, 'updateBanner']);
    Route::get('/partners', [PartnerController::class, 'partners'])->name('partners');
    Route::post('createPartner', [PartnerController::class, 'createPartner'])->name('createPartner');
    Route::get('/portfolios', [PortfolioController::class, 'portfolios'])->name('portfolios');
    Route::post('createPortfolio', [PortfolioController::class, 'createPortfolio'])->name('createPortfolio');
    Route::get('/portfolioCategories', [PortfolioController::class, 'portfolioCategories'])->name('portfolioCategories');
    Route::post('createPortfolioCategory', [PortfolioController::class, 'createPortfolioCategory'])->name('createPortfolioCategory');
    Route::get('/teams', [TeamController::class, 'teams'])->name('teams');
    Route::post('createTeam', [TeamController::class, 'createTeam'])->name('createTeam');
    Route::get('/testimonials', [TestimonialController::class, 'testimonials'])->name('testimonials');
    Route::post('createTestimonial', [TestimonialController::class, 'createTestimonial'])->name('createTestimonial');
    Route::post('delete', [AdminController::class, 'delete'])->name('delete');
    Route::get('/sidebar', function () {
        return view('layouts.sidebar');
    })->name('sidebar');
});