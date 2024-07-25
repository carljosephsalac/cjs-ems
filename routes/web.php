<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Middleware\UserOnly;
use Illuminate\Support\Facades\Route;

Route::controller(EmployeeController::class)->group(function() {
    Route::middleware(UserOnly::class)->group(function() {
        Route::get('/home', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{currentEmployee}', 'edit')->name('edit');
        Route::put('/update/{currentEmployee}', 'update')->name('update');
        Route::get('/delete/{currentEmployee}', 'delete')->name('delete');
        Route::delete('/destroy/{currentEmployee}', 'destroy')->name('destroy');
    });
});

Route::controller(AuthController::class)->group(fn() => [
    Route::get('/', 'index')->name('auth.index'),
    Route::post('/auth', 'store')->name('auth.store'),
    Route::post('/auth/login', 'login')->name('auth.login'),
    Route::post('/auth/logout', 'logout')->name('auth.logout')->middleware(UserOnly::class),
]);