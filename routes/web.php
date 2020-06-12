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
});

Route::get('/prelaunch', function () {
    return view('prelaunch.welcome');
});
Route::name('prelaunch')->post('/join', 'LandingController@store');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/login', 'HomeController@login');
Route::post('/login', 'Auth\AuthController@login')->name('login');
Route::get('/logout', 'Auth\AuthController@logout')->name('logout');

Route::get('auth/{provider}', 'Auth\UserSocialAuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\UserSocialAuthController@handleProviderCallback');
Route::get('auth/{provider}/callback/error', 'Auth\UserSocialAuthController@error');
Route::get('ValidateLogin/{id}/{hash}', 'Auth\UserSocialAuthController@validateLogin')->name('validate.login')->middleware('signed');

Route::get('/Register/{type?}', 'HomeController@register')->where([
    'type' => 'Free|Contributor'
]);;;
Route::post('/Register', 'Auth\AuthController@register')->name('register');
Route::post('/ForgotPassword', 'Auth\AuthController@sedEmailForgotPassword');

Route::get('/Help', 'HomeController@help')->name('help');
Route::get('/About', 'HomeController@about')->name('about');
Route::get('/Carrers', 'HomeController@carrers')->name('carrers');
Route::get('/Terms', 'HomeController@terms')->name('terms');

Route::group(['prefix' => 'User', 'middleware' => ['auth']], function () {
    Route::name('profile.edit.image.profle')->post('/Edit/imageProfile/{username}', 'User\UserController@updateImage');
    Route::name('profile.edit.image.cover')->post('/Edit/imageCover/{username}', 'User\UserController@updateCover');
    Route::name('profile.edit.user.settings')->get('/Settings/{username}', 'User\UserController@accountSettings');
    Route::name('profile.update.user')->post('/Settings/Update/{username}', 'User\UserController@updateUser');
    Route::name('profile.update.user.personal')->post('/Settings/Personal/Update/{username}', 'User\UserPersonalInformationController@update');
});

Route::group(['prefix' => '/{username}'], function () {
    Route::group(['middleware' => ['auth']], function () {
        Route::name('profile.edit')->get('/Edit', 'User\UserController@profileEdit');//todos el mismo name???
        Route::name('profile.get')->get('/Edit/get/', 'User\UserPersonalInformationController@get');
        Route::name('profile.update')->post('/Edit/Profile', 'User\UserProfileInformationController@update');
        Route::name('profile.save')->post('/Save/Profile', 'User\UserProfileInformationController@save');
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
        Route::name('post.get')->get('/get/{token}/', 'Post\PostController@get');
        Route::group(['middleware' => ['auth']], function () {
            Route::name('post.store')->post('/store', 'Post\PostController@store');
            Route::name('post.update')->put('/update', 'Post\PostController@update');
        });
    });

    Route::group(['prefix' => 'Comment'], function () {
        Route::group(['middleware' => ['auth']], function () {
            Route::name('comment.store')->post('/store/{model}/{model_id}', 'Comment\CommentController@store');
            Route::name('comment.update')->put('/update', 'Comment\CommentController@update');
            Route::name('comment.delete')->delete('/delete', 'Comment\CommentController@delete');
        });
    });

    Route::group(['prefix' => 'LitLike'], function () {
        Route::group(['middleware' => ['auth']], function () {
            Route::name('litlike.store.like')->post('/like/{model}/{model_id}', 'User\LitLikeController@like');
            Route::name('litlike.unlike')->post('/unlike/{like}', 'User\LitLikeController@unlike');
        });
    });

    Route::group(['prefix' => 'VotePost'], function () {
        Route::group(['middleware' => ['auth']], function () {
            Route::name('vote.store.up')->post('/VoteUp/{post}/{vote?}', 'Post\VotePostsController@voteUp');
            Route::name('vote.unvote.up')->post('/UnVoteUp/{vote}', 'Post\VotePostsController@unvoteUp');
            Route::name('vote.store.down')->post('/VoteDown/{post}/{vote?}', 'Post\VotePostsController@voteDown');
            Route::name('vote.unvote.down')->post('/UnVoteDown/{vote}', 'Post\VotePostsController@unvoteDown');
        });
    });
});



Route::get('/report', function(){
    return view('reports');
});