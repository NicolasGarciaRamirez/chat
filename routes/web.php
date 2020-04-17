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
Route::post('/Register', 'Auth\AuthController@register')->name('register');

Route::get('/Help', 'HomeController@help')->name('help');
Route::get('/About', 'HomeController@about')->name('about');
Route::get('/Carrers', 'HomeController@carrers')->name('carrers');
Route::get('/Terms', 'HomeController@terms')->name('terms');

Route::group(['prefix' => 'Profile'], function(){
    Route::get('/Edit', 'User\UserController@profileEdit')->name('profile.edit');
    Route::get('/Channel/Activity', 'User\UserController@channelActivity')->name('profile.channel.activity');
    Route::get('/Channel/Playlist', 'User\UserController@channelPlaylist')->name('profile.channel.playlist');
    Route::get('/Channel/Edit', 'User\UserController@channelEdit')->name('profile.channel.edit');
    Route::get('/Settings', 'User\UserController@accountSettings')->name('profile.account.settings');

    Route::get('/View', 'User\UserController@viewProfile')->name('view.profile');
});
