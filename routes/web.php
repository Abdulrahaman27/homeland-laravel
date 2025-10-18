<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Props\PropertiesController;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [PropertiesController::class, 'index'])->name('home');
Route::get('/props/prop-details/{id}', [PropertiesController::class, 'single'])->name('single.prop');


// Inserting requests
Route::post('/props/prop-details/{id}', [PropertiesController::class, 'insertRequest'])->name('insert.request');

// Inserting saved properties
Route::post('/props/prop-details/save/{id}', [PropertiesController::class, 'saveProps'])->name('save.prop');
Route::delete('/props/prop-details/delete/{id}', [PropertiesController::class, 'deleteProps'])->name('delete.prop');