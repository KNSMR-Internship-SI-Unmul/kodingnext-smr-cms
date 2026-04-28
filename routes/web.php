<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PromotionController;   


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

Route::get('/dashboard/courses', function () {
    return view('pages.courses.index');
});

Route::get('/modules', function () {
    return view('pages.modules.index');
});

Route::resource('/employees/roles', RoleController::class);

Route::resource('/employees', EmployeeController::class);

Route::resource('/students', StudentController::class);

Route::resource('/promotions', PromotionController::class);

Route::get('/student-projects', function () {
    return view('pages.student-projects.index');
});

Route::get('/student-projects/{id}', function ($id) {
    return view('pages.student-projects.show', ['projectId' => $id]);
});

Route::get('/events', function () {
    return view('pages.events.index');
});

Route::get('/general-testimonials', function () {
    return view('pages.general-testimonials.index');
});

