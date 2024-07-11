<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('showHome');
});

Route::controller(EmployeeController::class)->group(function() {
    Route::get('/home', 'showHome')->name('showHome');
    Route::post('/store', 'store')->name('store');
    Route::get('/{currentEmployee}/edit', 'edit')->name('edit');
    Route::put('/{currentEmployee}/update', 'update')->name('update');
    Route::get('/{currentEmployee}/delete', 'delete')->name('delete');
    Route::delete('/{currentEmployee}/destroy', 'destroy')->name('destroy');
});