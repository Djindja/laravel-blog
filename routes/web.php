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

Route::group(['middleware' => ['web']], function(){
    // Authentication Routes
    Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
    Route::post('auth/login', 'Auth\LoginController@postLogin');
    Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@getLogout']);

    //Registration Routes
    Route::get('auth/register', 'Auth\RegisterController@getRegister');
    Route::post('auth/register', 'Auth\RegisterController@postRegister');

    // Password Reset Routes
    Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\PasswordController@reset');

    // Categories
    Route::resource('categories', 'CategoryController', ['except' => ['create']]);

    Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
    Route::get('blog', ['uses' => 'BlogController@getIndex', 'as' => 'blog.index']);
    Route::get('/', 'PagesController@getIndex');
    Route::get('/about', 'PagesController@getAbout');
    Route::get('/contact', 'PagesController@getContact');
    Route::resource('posts', 'PostController');
});
