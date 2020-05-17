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


Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'User'], function () {
        Route::name('profile.edit.image.profle')->post('/Edit/imageProfile/{user}', 'User\UserController@updateImage');
        Route::name('profile.edit.image.cover')->post('/Edit/imageCover/{user}', 'User\UserController@updateCover');
    });

    Route::group(['prefix' => 'Profile'], function(){
        Route::name('profile.edit')->get('/Edit', 'User\UserController@profileEdit');
        Route::name('profile.get')->get('/Edit/get/', 'User\UserPersonalInformationController@get');
        Route::name('profile.edit.update')->post('/Edit/Update/{user}', 'User\UserPersonalInformationController@update');
        Route::name('profile.channel.activity')->get('/Channel/Activity', 'User\UserController@channelActivity');
        Route::name('profile.channel.playlist')->get('/Channel/Playlist', 'User\UserController@channelPlaylist');
        Route::name('profile.channel.edit')->get('/Channel/Edit/', 'User\UserController@channelEdit');
        Route::name('profile.account.settings')->get('/Settings', 'User\UserController@accountSettings');

        Route::group(['prefix' => 'Post'], function () {
            Route::name('post.get')->get('/get/{user}', 'User\UserPostController@get');
            Route::name('post.save')->post('/Save/{user}', 'User\UserPostController@save');
            Route::name('post.update')->put('/update/{user}', 'User\UserPostController@update');
        });
    });

    Route::group(['prefix' => 'Comments'], function () {
        Route::name('comment.get')->get('/get/{userPost}', 'Comments\CommentsController@get');
        Route::name('comment.save')->post('/save/{userPost}', 'Comments\CommentsController@save');
        Route::name('comment.update')->put('/update/{userPost}', 'Comments\CommentsController@update');
        Route::name('comment.delete')->delete('/delete/{userPost}', 'Comments\CommentsController@delete');
    });
});
Route::group(['prefix' => 'View'], function () {
    Route::group(['prefix' => 'Channel'], function () {
        Route::name('view.profile.channel.activity')->get('/Activity/{username}', 'User\ViewUserController@activity');
        Route::name('view.profile.channel.playlist')->get('/Playlist/{username}', 'User\ViewUserController@playlist');
    });
    Route::group(['prefix' => 'Profile'], function () {
        Route::name('view.profile.releases')->get('/Releases/{username}', 'User\ViewUserController@releases');
        Route::name('view.profile.members')->get('/Members/{username}', 'User\ViewUserController@members');
        Route::name('view.profile.work.history')->get('/WorkHistory/{username}', 'User\ViewUserController@workHistory');
        Route::name('view.profile.genres')->get('/Genres/{username}', 'User\ViewUserController@genres');
        Route::name('view.profile.services')->get('/Services/{username}', 'User\ViewUserController@services');
        Route::name('view.profile.rates')->get('/Rates/{username}', 'User\ViewUserController@rates');
    });
    Route::group(['prefix' => 'Post'], function () {
        Route::name('post.get')->get('/get/{user}', 'User\UserPostController@get');
    });
    Route::group(['prefix' => 'Comments'], function () {
        Route::name('comment.get')->get('/get/{userPost}', 'Comments\CommentsController@get');
    });
});
