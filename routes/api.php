<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Middleware\AuthHeader;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Banners
Route::get('banners', [ApiController::class, 'banners'])->middleware(AuthHeader::class);
Route::get('partners', [ApiController::class, 'partners'])->middleware(AuthHeader::class);
Route::get('portfolios', [ApiController::class, 'portfolios'])->middleware(AuthHeader::class);
Route::get('portfolioCategories', [ApiController::class, 'portfolioCategories'])->middleware(AuthHeader::class);
