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
Route::get('/test', function () {
    $user = App\Models\User\User::find(1);
    $user->password = ('123456');
    $user->update();

});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/login', 'HomeController@login');
Route::post('/login', 'Auth\AuthController@login')->name('login');
Route::get('/logout', 'Auth\AuthController@logout')->name('logout');

Route::get('/Register/{type?}', 'HomeController@register')->where([
    'type' => 'Free|Contributor'
]);;;
Route::post('/Register', 'Auth\AuthController@register')->name('register');

Route::get('/Help', 'HomeController@help')->name('help');
Route::get('/About', 'HomeController@about')->name('about');
Route::get('/Carrers', 'HomeController@carrers')->name('carrers');
Route::get('/Terms', 'HomeController@terms')->name('terms');

Route::post('/Auth/Check', 'Auth\AuthController@authCheck');

// Route::get('/login/facebook', 'Auth\AuthController@redirectToProvider');
// Route::get('/login/facebook/callback', 'Auth\AuthController@handleProviderCallback');



Route::group(['prefix' => 'User','middleware' => ['auth']],  function () {
    Route::name('profile.edit.image.profle')->post('/Edit/imageProfile/{username}', 'User\UserController@updateImage');
    Route::name('profile.edit.image.cover')->post('/Edit/imageCover/{username}', 'User\UserController@updateCover');
    Route::name('profile.edit.user.settings')->get('/Settings/{username}', 'User\UserController@accountSettings');
});

Route::group(['prefix' => '/{username}'], function(){
    Route::group(['middleware' => ['auth']], function () {
        Route::name('profile')->get('/Edit', 'User\UserController@profileEdit');
        Route::name('profile')->get('/Edit/get/', 'User\UserPersonalInformationController@get'); 
        Route::name('profile')->post('/Edit/Profile', 'User\UserPersonalInformationController@update');
    });

    Route::group(['prefix' => 'Channel'], function () {
        Route::name('profile.channel.activity')->get('/Activity', 'User\UserController@channelActivity');
        Route::name('profile.channel.playlist')->get('/Playlist', 'User\UserController@channelPlaylist');
        Route::group(['middleware' => ['auth']], function () {
            Route::name('profile.channel.edit')->get('/Edit', 'User\UserController@channelEdit');
        });
    });

    Route::group(['prefix' => 'Profile'], function () {
        Route::name('profile.releases')->get('/Releases', 'User\ViewUserController@releases');
        Route::name('profile.members')->get('/Members', 'User\ViewUserController@members');
        Route::name('profile.work.history')->get('/WorkHistory', 'User\ViewUserController@workHistory');
        Route::name('profile.genres')->get('/Genres', 'User\ViewUserController@genres');
        Route::name('profile.services')->get('/Services', 'User\ViewUserController@services');
        Route::name('profile.rates')->get('/Rates', 'User\ViewUserController@rates');
    });

    Route::group(['prefix' => 'Post'], function () {
        // Route::name('post.get')->get('/get', 'User\UserPostController@get');
        Route::group(['middleware' => ['auth']], function () {
            Route::name('post.save')->post('/Save', 'User\UserPostController@save');
            Route::name('post.update')->put('/update', 'User\UserPostController@update');
        });
    });
    
    Route::group(['prefix' => 'Comments'], function () {
        Route::name('comment.get')->get('/get/{userPost}', 'Comments\CommentsController@get');
        Route::group(['middleware' => ['auth']], function () {
            Route::name('comment.save')->post('/save', 'Comments\CommentsController@save');
            Route::name('comment.update')->put('/update', 'Comments\CommentsController@update');
            Route::name('comment.delete')->delete('/delete', 'Comments\CommentsController@delete');
        });
    });
});

    

