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
// Deleting saved properties
Route::delete('/props/prop-details/delete/{id}', [PropertiesController::class, 'deleteProps'])->name('delete.prop');

// get properties by type (Buy) 
Route::get('/props/type/Buy', [PropertiesController::class, 'propsBuy'])->name('buy.prop');

// get properties by type (Rent) 
Route::get('/props/type/Rent', [PropertiesController::class, 'propsRent'])->name('rent.prop');

// displaying property by home_type
Route::get('/props/home-type/{hometype}', [PropertiesController::class, 'displayByHomeType'])->name('display.prop.hometype');
