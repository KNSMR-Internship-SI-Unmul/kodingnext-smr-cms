<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PromotionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('promotions')->group(function () {
    Route::get('/', [PromotionController::class, 'index']);
    Route::get('/{id}', [PromotionController::class, 'show']);
});

Route::prefix('events')->group(function () {
    Route::get('/', [\App\Http\Controllers\Api\EventController::class, 'index']);
    Route::get('/{id}', [\App\Http\Controllers\Api\EventController::class, 'show']);
});