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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/login', 'HomeController@login');
Route::post('/login', 'Auth\AuthController@login')->name('login');

// Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'User'], function () {
        Route::name('user.profile')->get('/profile', 'User\UserController@profile');
        Route::name('user.edit.profile')->get('/profile/edit', 'User\UserController@editProfile');
        Route::name('user.channel')->get('/channel', 'User\UserController@channel');    
    });
// });
