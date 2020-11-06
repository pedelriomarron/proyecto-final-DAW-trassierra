<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/contact', 'ContactController@contact')->name('contact');
Route::post('/contact', 'ContactController@contactPost')->name('contactPost');

Route::resource('cars', 'CarController');
//Route::resource('brands', 'BrandController');


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/private', 'PrivateController@index')->name('private');


Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
})->name('locale');



Route::group(['middleware' => ['auth']], function () {
    Route::resource('admin-panel/roles', 'RoleController');
    Route::resource('admin-panel/users', 'UserController');
    Route::get('profile', 'UserController@profile')->name('profile');
    Route::post('profile', 'UserController@update_avatar')->name('profile.update_avatar');
    Route::resource('admin-panel/brands', 'BrandController');
    Route::post('admin-panel/brands/update', 'BrandController@update')->name('brands.update');
    Route::get('admin-panel/brands/destroy/{id}', 'BrandController@destroy')->name('brands.deletebyid');;
    Route::get('/ajax_upload', 'AjaxUploadController@index');
    Route::post('/ajax_upload/action', 'AjaxUploadController@action')->name('ajaxupload.action');
    Route::resource('products', 'ProductController');
    //Admin
    Route::get('/admin-panel', 'AdminController@index')->name('admin');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::put('/themes', function (Request $request) {
    $theme = "light";
    $request->theme === null ? $theme = 'light' : $theme = 'dark';
    // dd($request->theme);
    session(['theme' => $theme]);
    return back();
})->name('themes');
