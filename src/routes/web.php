<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Rutas Publicas
|--------------------------------------------------------------------------
*/

Route::get('/', 'CarController@public_index')->name('car_public_index');
Route::get('/cars', 'CarController@public_index')->name('car_public_index');
Route::get('/car/{id}', 'CarController@show_car')->name('show_car');

Route::get('/home', 'CarController@public_index')->name('home');

// Contacto
Route::get('/contact', 'ContactController@contact')->name('contact');
Route::post('/contact', 'ContactController@contactPost')->name('contactPost');

//Collaborate
Route::get('/collaborate', 'CollaborateController@index')->name('collaborate');
Route::post('/collaborate', 'CollaborateController@send_mail')->name('addCollaborate');

// Idioma
Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
})->name('locale');

//Auth
Auth::routes(['verify' => true]);
Auth::routes();

//Login google
Route::get('login/google', [LoginController::class, 'redirectToProvider'])->name('login.google');
Route::get('login/google/callback', [LoginController::class, 'handleProviderCallback'])->name('callback.google');

// Tema dark
Route::put('/themes', function (Request $request) {
    $theme = "light";
    $request->theme === null ? $theme = 'light' : $theme = 'dark';
    // dd($request->theme);
    session(['theme' => $theme]);
    return back();
})->name('themes');




// Usuarios Identificados
Route::group(['middleware' => ['auth', 'verified']], function () {
    //index
    Route::get('/admin-panel', 'AdminController@index')->name('admin');
    // Profile
    Route::get('/admin-panel/profile', 'UserController@profile')->name('profile');
    Route::post('/admin-panel/profile', 'UserController@update_avatar')->name('profile.update_avatar');
    // API
    Route::get('admin-panel/api', 'AdminApiController@index')->name('admin.api');
    Route::POST('admin-panel/api/generate', 'AdminApiController@generate')->name('admin.api.generate');
    // Comparate
    Route::get('comparate', 'ComparateController@index')->name('comparate');
    //Favoritos
    Route::get('favorite/{id}', 'FavoriteController@save')->name('favorite.save');
    Route::get('favourites', 'FavoriteController@index')->name('favorite.index');
});



//Usuarios Administradores
Route::group(['middleware' => ['auth', 'verified', 'role:Admin']], function () {

    //Role
    Route::resource('admin-panel/roles', 'RoleController');
    //users
    Route::resource('admin-panel/users', 'UserController');
    Route::get('admin-panel/users/destroy/{id}', 'UserController@destroy')->name('users.deletebyid');
    // experts
    Route::resource('admin-panel/experts', 'ExpertController');
    // Cars
    Route::get('admin-panel/cars/destroy/{id}', 'CarController@destroy')->name('cars.deletebyid');
    //Brands
    Route::resource('admin-panel/brands', 'BrandController');
    Route::post('admin-panel/brands/update', 'BrandController@update')->name('brands.update');
    Route::get('admin-panel/brands/destroy/{id}', 'BrandController@destroy')->name('brands.deletebyid');
    //Bodystyles
    Route::resource('admin-panel/bodystyles', 'BodystyleController');
    Route::post('admin-panel/bodystyles/update', 'BodystyleController@update')->name('bodystyles.update');
    Route::get('admin-panel/bodystyles/destroy/{id}', 'BodystyleController@destroy')->name('bodystyles.deletebyid');
    //Drives
    Route::resource('admin-panel/drives', 'DriveController');
    Route::post('admin-panel/drives/update', 'DriveController@update')->name('drives.update');
    Route::get('admin-panel/drives/destroy/{id}', 'DriveController@destroy')->name('drives.deletebyid');
    //Segments
    Route::resource('admin-panel/segments', 'SegmentController');
    Route::post('admin-panel/segments/update', 'SegmentController@update')->name('segments.update');
    Route::get('admin-panel/segments/destroy/{id}', 'SegmentController@destroy')->name('segments.deletebyid');
    //Ajax
    Route::get('/ajax_upload', 'AjaxUploadController@index');
    Route::post('/ajax_upload/action', 'AjaxUploadController@action')->name('ajaxupload.action');
});



// Usuarios Expertos
Route::group(['middleware' => ['auth', 'verified', 'role:Admin|Expert']], function () {
    //Cars
    Route::resource('admin-panel/cars', 'CarController');
    //Gallery
    Route::get('image-gallery', 'ImageGalleryController@index');
    Route::post('image-gallery', 'ImageGalleryController@upload');
    Route::post('image-gallery/order', 'ImageGalleryController@order')->name('gallery.order');
    Route::delete('image-gallery/{id}', 'ImageGalleryController@destroy');
});
