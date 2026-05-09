<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PromotionController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\ModuleController;
use App\Http\Controllers\Api\CourseTypeController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\StudentProjectController;
use App\Http\Controllers\Api\GeneralTestimonialController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('employees')->group(function () {
    Route::get('/', [EmployeeController::class, 'index']);
    Route::get('/{id}', [EmployeeController::class, 'show']);
});

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

Route::prefix('student-projects')->group(function () {
    Route::get('/', [StudentProjectController::class, 'index']);
    Route::get('/{id}', [StudentProjectController::class, 'show']);
});

Route::prefix('reviews')->group(function () {
    Route::get('/', [GeneralTestimonialController::class, 'index']);
    Route::get('/{id}', [GeneralTestimonialController::class, 'show']);
});