<?php

use Illuminate\Support\Facades\Route;

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


Route::group(['namespace' => 'Admin', 'middleware' => 'guest:admin'], function () {
    Route::get('/login', 'LoginController@getLogin')->name('admin.getLogin'); 
    Route::post('/login', 'LoginController@login')->name('admin.login'); 
});

Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {
    ######################## Dashboard Routes ########################
    Route::get('/', function () { return view('layouts.admin'); })->name('admin.dashboard'); 
    ######################## /Dashboard Routes ########################
    
    ######################## Languages Routes ########################
    Route::group(['prefix' => 'language'], function () {
        Route::get('',  'LanguageController@index'  )->name('admin.language.index'); 
        Route::post('', 'LanguageController@store' )->name('admin.language.store'); 
        Route::delete('/{id}', 'LanguageController@destroy' )->name('admin.language.destroy'); 
        Route::get('/{id}', 'LanguageController@show' )->name('admin.language.show'); 
        Route::get('/{id}/edit', 'LanguageController@edit' )->name('admin.language.edit'); 
        Route::put('/{id}', 'LanguageController@update' )->name('admin.language.update'); 
    });
    ######################## /Languages Routes ########################
    
    ######################## Main Categories Routes ########################
    Route::group(['prefix' => 'categories'], function () {
        Route::get('',  'MainCategoriesController@index'  )->name('admin.main.categories.index'); 
        Route::post('', 'MainCategoriesController@store' )->name('admin.main.categories.store'); 
        Route::delete('/{id}', 'MainCategoriesController@destroy' )->name('admin.main.categories.destroy'); 
        Route::get('/{id}', 'MainCategoriesController@show' )->name('admin.main.categories.show'); 
        Route::get('/{id}/edit', 'MainCategoriesController@edit' )->name('admin.main.categories.edit'); 
        Route::put('/{id}', 'MainCategoriesController@update' )->name('admin.main.categories.update'); 
    });
    ######################## /Main Categories Routes ########################
    
    ######################## Vendors Routes ########################
    Route::group(['prefix' => 'vendors'], function () {
        Route::get('',  'VendorsController@index'  )->name('admin.vendors.index'); 
        Route::post('', 'VendorsController@store' )->name('admin.vendors.store'); 
        Route::delete('/{id}', 'VendorsController@destroy' )->name('admin.vendors.destroy'); 
        Route::get('/{id}', 'VendorsController@show' )->name('admin.vendors.show'); 
        Route::get('/{id}/edit', 'VendorsController@edit' )->name('admin.vendors.edit'); 
        Route::put('/{id}', 'VendorsController@update' )->name('admin.vendors.update');
    });
    ######################## /Vendors Routes ########################

});
