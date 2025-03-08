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

Route::get('/', 'HomeController@index')->name('login');
Route::get('/account/verify/{uname}', 'AuthController@accountVerify')->name('verify');

Route::middleware(['guest'])->group(function () {

    Route::get('/signup', 'AuthController@signUp')->name('signup');
    Route::get('/forgot-password', 'AuthController@forgotPassword')->name('forgot');
    Route::post('/forgot-password/successfully', 'AuthController@forgotPasswordPost')->name('forgot.post');
    Route::get('/forgot-password/change/{uname}', 'AuthController@changePassword')->name('forgot.change');
    Route::post('/forgot-password/post', 'AuthController@changePasswordPost')->name('forgot.password');

    Route::post('/authenticate', 'AuthController@auth')->name('auth');
    Route::post('/signup/successfully', 'AuthController@signUpPost')->name('signup.post');
});

Route::get('/posts/{slug}', 'PostController@index')->name('posts.view');
Route::get('/paypal/donate/{username?}', 'PaypalController@index')->name('paypal.donate');

Route::middleware(['auth'])->group(function () {

    Route::prefix('paginate')->group(function () {
        Route::post('/index', 'PaginateController@index');
        Route::post('/home', 'PaginateController@home');
        Route::post('/tags', 'PaginateController@tags');
        Route::post('/comment', 'PaginateController@comment');
        Route::post('/search/people', 'PaginateController@searchPeople');
        Route::post('/search/post', 'PaginateController@searchPost');
        Route::post('/search/tags', 'PaginateController@searchTags');
        Route::post('/followers', 'PaginateController@followers');
        Route::post('/following', 'PaginateController@following');
    });

    Route::get('/about', 'InfoController@about')->name('about');
    Route::get('/terms', 'InfoController@terms')->name('terms');
    Route::get('/contact', 'InfoController@contact')->name('contact');
    Route::get('/donate', 'InfoController@donate')->name('donate');

    Route::get('/signout', 'AuthController@signOut')->name('signout');

    Route::get('/tags/{tags}', 'TagsController@index')->name('tags');
    Route::get('/search', 'SearchController@index')->name('search');

    Route::get('/posts/{slug}/edit', 'PostController@edit')->name('posts.edit');
    Route::post('/posts/update', 'PostController@update')->name('posts.update');
    Route::post('/posts/delete', 'PostController@destroy')->name('posts.delete');
    Route::post('/posts/submit', 'PostController@store')->name('posts.submit');
    Route::post('/posts/report', 'PostController@report')->name('posts.report');

    Route::get('/drafts', 'PostController@drafts')->name('posts.drafts');
    Route::get('/bookmarks', 'PostController@bookmarks')->name('posts.bookmarks');

    Route::get('/{username}/followers', 'FollowController@followers')->name('followers');
    Route::get('/{username}/following', 'FollowController@following')->name('following');
    Route::post('/follow', 'FollowController@follow')->name('follow');

    Route::post('/bookmark', 'FeedController@bookmark');
    Route::post('/view', 'FeedController@view');
    Route::post('/like', 'FeedController@like');
    Route::post('/comment/add', 'FeedController@commentAdd');
    Route::post('/comment/edit', 'FeedController@commentEdit');
    Route::post('/comment/delete', 'FeedController@commentDelete');

    Route::get('/settings', 'SettingsController@index')->name('settings.user');
    Route::post('/settings/upload', 'SettingsController@image')->name('settings.upload');
    Route::post('/settings/general', 'SettingsController@general')->name('settings.general');
    Route::post('/settings/password', 'SettingsController@password')->name('settings.password');
    Route::get('/settings/resend-verification', 'SettingsController@resendVerify')->name('settings.resend');

    Route::get('/{username}', 'HomeController@home')->name('user.home');
});
