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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function(){
    Route::get('dashboard', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'app'], function() {
        Route::post('store', 'General\AppController@store')->name('App.Store');
        Route::group(['prefix' => '{appEntity}'], function() {
            Route::get('show', 'General\AppController@show')->name('App.Show');
            Route::get('scanTests', 'General\AppController@scanTests')->name('App.ScanTests');
        });
    });

    Route::group(['prefix' => 'tag'], function() {
        Route::group(['prefix' => '{tagEntity}'], function() {
            Route::get('show', 'General\TagController@show')->name('Tag.Show');
        });
    });

    Route::group(['prefix' => 'method'], function() {
        Route::group(['prefix' => '{methodEntity}'], function() {
            Route::get('run', 'General\MethodController@run')->name('Method.Run');
        });
    });

});

Route::get('login', function () {return redirect('/');});