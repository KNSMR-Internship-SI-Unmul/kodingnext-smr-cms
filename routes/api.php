<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PromotionController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\ModuleController;
use App\Http\Controllers\Api\CourseTypeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('promotions')->group(function () {
    Route::get('/', [PromotionController::class, 'index']);
    Route::get('/{id}', [PromotionController::class, 'show']);
});

Route::prefix('events')->group(function () {
    Route::get('/', [EventController::class, 'index']);
    Route::get('/{id}', [EventController::class, 'show']);
});

Route::prefix('courses')->group(function () {
    Route::get('/', [CourseTypeController::class, 'index']);
    Route::get('/{id}', [CourseTypeController::class, 'show']);
});

Route::prefix('modules')->group(function () {
    Route::get('/', [ModuleController::class, 'index']);
    Route::get('/{id}', [ModuleController::class, 'show']);
});