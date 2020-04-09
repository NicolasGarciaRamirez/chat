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

Route::get('/Register', 'HomeController@register');
Route::post('/Register/save', 'HomeController@saveUser')->name('sigup');

// Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'User'], function () {

        Route::group(['prefix' => 'Contributor'], function () {
            Route::name('user.profile')->get('/profile', 'User\UserController@profile');
            Route::name('user.profile.save')->post('/profile/save/{user}', 'User\UserController@save');
            Route::name('user.profile.update')->post('/profile/update/{user}', 'User\UserController@update');
            Route::name('user.edit.profile')->get('/profile/edit', 'User\UserController@editProfile');


            Route::name('user.channel')->get('/channel', 'User\UserController@channel');
            Route::name('user.channel.save')->post('/channel/save/{user}', 'User\UserController@chanelSave');
            Route::name('user.channel.update')->post('/channel/update/{user}', 'User\UserController@channelUpdate');
        });

        Route::group(['prefix' => 'Company'], function () {
            Route::name('company.profile')->get('/profile' , 'User\UserCompanyController@profile');
        });
    });
        
// });
