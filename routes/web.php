<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Props\PropertiesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Users\UsersController;
// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();
Route::get('/', [PropertiesController::class, 'index'])->name('home');
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

// users pages
Route::get('/user/all-requests', [UsersController::class, 'allRequests'])->name('all.requests');

// displaying saved properties
Route::get('/user/saved-properties', [UsersController::class, 'savedProperties'])->name('saved.props');

// display contact page
Route::get('contact', [HomeController::class, 'contact'])->name('contact');

// display about page
Route::get('about', [HomeController::class, 'about'])->name('about');

// displaying property by PRICE ASCENDING
Route::get('/props/price-asc', [PropertiesController::class, 'priceAsc'])->name('price.asc.prop');

// displaying property by PRICE DESCENDING
Route::get('/props/price-desc', [PropertiesController::class, 'priceDesc'])->name('price.desc.prop');
