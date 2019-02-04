<?php
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


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', "PeopleController@create");



//Route::get('/vue/{any}', 'SpaController@index')->where('any', '.*');
Route::get('/vue3', 'SpaController@index');



//Route::get('/admin', 'AdminController@admin')->middleware('is_admin')->name('admin');
Route::group(['middleware' => ['is_admin'], 'name' => 'admin'], function(){

    Route::get('/admin', 'AdminController@admin');
    Route::get('/admin/edit/{id}', 'AdminController@edit')->name('admin.edit');
    Route::post('/admin/update/{id}', 'AdminController@update')->name('admin.update');
    Route::delete('/admin/{id}', 'AdminController@destroy')->name('admin.destroy');
});


Route::group(['name' => 'people'], function(){

    Route::get('/people', 'PeopleController@index');
    Route::post('/people', 'PeopleController@store');
    Route::get('/people/create', 'PeopleController@create');
    Route::get('/people/{person}', 'PeopleController@show');
    Route::post('/people/update/{person}', 'PeopleController@update');
    Route::post('/people/update_hidden/{person}', 'PeopleController@update_hidden');
    Route::get('/people/{person}/edit', 'PeopleController@edit');
});

Auth::routes();

