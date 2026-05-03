<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CourseTypeController;
use App\Http\Controllers\ModuleController;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

Route::resource('/dashboard/courses', CourseTypeController::class);

Route::resource('/modules', ModuleController::class);

Route::resource('/employees/roles', RoleController::class);

Route::resource('/employees', EmployeeController::class);

Route::resource('/students', StudentController::class);

Route::delete('promotions/bulk-delete', [\App\Http\Controllers\PromotionController::class, 'bulkDestroy'])->name('promotions.bulkDestroy');

Route::resource('/promotions', PromotionController::class);

Route::delete('events/bulk-delete', [\App\Http\Controllers\EventController::class, 'bulkDestroy'])->name('events.bulkDestroy');

Route::resource('/events', EventController::class);

Route::get('/student-projects', function () {
    return view('pages.student-projects.index');
});

Route::get('/student-projects/{id}', function ($id) {
    return view('pages.student-projects.show', ['projectId' => $id]);
});

Route::get('/general-testimonials', function () {
    return view('pages.general-testimonials.index');
});

