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
Route::get('/all-admins', [AdminsController::class, 'allAdmins'])->name('admins.admins');

    // admins create
Route::get('/create-admins', [AdminsController::class, 'createAdmins'])->name('admins.create');
Route::post('/create-admins', [AdminsController::class, 'storeAdmins'])->name('admins.store');
    // home types routes
Route::get('/all-hometypes', [AdminsController::class, 'allHomeTypes'])->name('admins.hometypes');
Route::get('/create-hometypes', [AdminsController::class, 'createHomeTypes'])->name('hometypes.create');
Route::post('/create-hometypes', [AdminsController::class, 'storeHomeTypes'])->name('hometypes.store');

// Update home types
Route::get('/edit-hometypes/{id}', [AdminsController::class, 'editHomeTypes'])->name('hometypes.edit');
Route::post('/edit-hometypes/{id}', [AdminsController::class, 'updateHomeTypes'])->name('hometypes.update');
Route::delete('/delete-hometypes/{id}', [AdminsController::class, 'deleteHomeTypes'])->name('hometypes.delete'); 

// Requests
Route::get('/all-requests', [AdminsController::class, 'requests'])->name('requests.all');


// Properties routes
Route::get('/all-properties', [AdminsController::class, 'allProperties'])->name('admins.properties');
Route::get('/create-properties', [AdminsController::class, 'createProperties'])->name('properties.create');
Route::post('/create-properties', [AdminsController::class, 'storeProperties'])->name('properties.store');  
Route::delete('/delete-properties/{id}', [AdminsController::class, 'deleteProperties'])->name('properties.delete'); 

});
