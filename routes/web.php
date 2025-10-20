<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Props\PropertiesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\Admins\AdminsController;
// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();
Route::get('/', [PropertiesController::class, 'index'])->name('home');
Route::get('/home', [PropertiesController::class, 'index'])->name('home');

// display contact page
Route::get('contact', [HomeController::class, 'contact'])->name('contact');

// display about page
Route::get('about', [HomeController::class, 'about'])->name('about');

Route::group(['prefix' => 'props'], function () {
    Route::get('prop-details/{id}', [PropertiesController::class, 'single'])->name('single.prop');

    // Inserting requests
    Route::post('prop-details/{id}', [PropertiesController::class, 'insertRequest'])->name('insert.request');
    
    // Inserting saved properties
    Route::post('prop-details/save/{id}', [PropertiesController::class, 'saveProps'])->name('save.prop');
    // Deleting saved properties
    Route::delete('prop-details/delete/{id}', [PropertiesController::class, 'deleteProps'])->name('delete.prop');
    
    // get properties by type (Buy) 
    Route::get('type/Buy', [PropertiesController::class, 'propsBuy'])->name('buy.prop');
    
    // get properties by type (Rent) 
    Route::get('type/Rent', [PropertiesController::class, 'propsRent'])->name('rent.prop');
    
    // displaying property by home_type
    Route::get('home-type/{hometype}', [PropertiesController::class, 'displayByHomeType'])->name('display.prop.hometype');

    // displaying property by PRICE ASCENDING
    Route::get('price-asc', [PropertiesController::class, 'priceAsc'])->name('price.asc.prop');

    // displaying property by PRICE DESCENDING
    Route::get('price-desc', [PropertiesController::class, 'priceDesc'])->name('price.desc.prop');

    // Searching for properties
    Route::any('search', [PropertiesController::class, 'searchProps'])->name('search.prop');
});


Route::group(['prefix' => 'user'], function () {
    // users pages
    Route::get('all-requests', [UsersController::class, 'allRequests'])->name('all.requests');
    
    // displaying saved properties
    Route::get('saved-properties', [UsersController::class, 'savedProperties'])->name('saved.props');
});

Route::get('admin/login', [AdminsController::class, 'viewLogin'])->name('view.login')->middleware('checkforauth');
Route::post('admin/login', [AdminsController::class, 'checkLogin'])->name('check.login');
Route::post('/admin/logout', function () {
    Auth::guard('admin')->logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('view.login');
})->name('admin.logout');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
// Admins routes
Route::get('/index', [AdminsController::class, 'index'])->name('admins.dashboard');
});