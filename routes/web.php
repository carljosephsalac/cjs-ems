<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::controller(EmployeeController::class)->group(function() {
    Route::get('/', 'index')->name('index');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{currentEmployee}', 'edit')->name('edit');
    Route::put('/update/{currentEmployee}', 'update')->name('update');
    Route::get('/delete/{currentEmployee}', 'delete')->name('delete');
    Route::delete('/destroy/{currentEmployee}', 'destroy')->name('destroy');
});
