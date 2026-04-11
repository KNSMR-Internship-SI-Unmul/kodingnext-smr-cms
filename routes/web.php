<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('pages.dashboard');
});

Route::get('/modules', function () {
    return view('pages.modules.index');
});

Route::get('/employees', function () {
    return view('pages.employees.index');
});

Route::get('/students', function () {
    return view('pages.students.index');
});

Route::get('/promotions', function () {
    return view('pages.promotions.index');
});

Route::get('/events', function () {
    return view('pages.events.index');
});