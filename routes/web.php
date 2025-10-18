<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Props\PropertiesController;
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [PropertiesController::class, 'index'])->name('home');
Route::get('/prop-details/{id}', [PropertiesController::class, 'single'])->name('single.prop');


// Inserting requests
Route::post('/prop-details/{id}', [PropertiesController::class, 'insertRequest'])->name('insert.request');
