<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CourseTypeController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\StudentProjectController;
use App\Http\Controllers\ProjectReviewController;
use App\Http\Controllers\GeneralTestimonialController;


// Route::get('/', function () {
//     return view('auth.login');
// });

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('/dashboard/courses', CourseTypeController::class);

    Route::resource('/modules', ModuleController::class);

    Route::resource('/employees/roles', RoleController::class);

    Route::resource('/employees', EmployeeController::class);

    Route::resource('/students', StudentController::class);

    Route::resource('project-reviews', ProjectReviewController::class)->only([
        'store', 'update', 'destroy'
    ]);

    Route::delete('student-projects/bulk-delete', [StudentProjectController::class, 'bulkDestroy'])->name('student-projects.bulkDestroy');

    Route::resource('/student-projects', StudentProjectController::class);

    Route::delete('promotions/bulk-delete', [PromotionController::class, 'bulkDestroy'])->name('promotions.bulkDestroy');

    Route::resource('/promotions', PromotionController::class);

    Route::delete('events/bulk-delete', [EventController::class, 'bulkDestroy'])->name('events.bulkDestroy');

    Route::resource('/events', EventController::class);

    Route::delete('general-testimonials/bulk-delete', [GeneralTestimonialController::class, 'bulkDestroy'])->name('general-testimonials.bulkDestroy');

    Route::resource('/general-testimonials', GeneralTestimonialController::class);
});



