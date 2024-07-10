<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::controller(EmployeeController::class)->group(function() {
    Route::get('/home', 'showHome')->name('showHome');
    Route::post('/store', 'store')->name('store');
    Route::get('/{employee}/edit', 'edit')->name('edit');
    Route::put('/{employee}/update', 'update')->name('update');
    Route::get('/{employee}/delete', 'delete')->name('delete');
    Route::delete('/{employee}/destroy', 'destroy')->name('destroy');
});