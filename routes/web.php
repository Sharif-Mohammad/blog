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

Route::post('subscriber', 'SubscriberController@store')->name('subscriber.store');

Route::get('posts', 'PostController@index')->name('post.index');

Route::get('post/{slug}', 'PostController@details')->name('post.details');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function(){

	Route::post('favourite/{post}/add', 'FavouriteController@add')->name('post.favourite');
	Route::post('comment/{post}', 'CommentController@store')->name('comment.store');
	Route::post('reply', 'ReplyController@store')->name('reply.store');
});

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'admin', 'middleware' => ['auth', 'admin']], function(){

	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
	Route::get('settings', 'SettingsController@index')->name('settings');
	Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
	Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');
	Route::resource('tag', 'TagController');
	Route::resource('category', 'CategoryController');
	Route::resource('post', 'PostController');

	Route::get('pending/post', 'PostController@pending')->name('post.pending');
	Route::put('/post/{id}/approve', 'PostController@approval')->name('post.approve');

	Route::get('/subscriber', 'SubscriberController@index')->name('subscriber.index');
	Route::delete('/subscriber/{subscriber}', 'SubscriberController@destroy')->name('subscriber.destroy');

	Route::get('/favourite', 'FavouriteController@index')->name('favourite.index');
});

Route::group(['as' => 'author.', 'prefix' => 'author', 'namespace' => 'author', 'middleware' => ['auth', 'author']], function(){

	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
	Route::get('settings', 'SettingsController@index')->name('settings');
	Route::put('profile-update', 'SettingsController@updateProfile')->name('profile.update');
	Route::put('password-update', 'SettingsController@updatePassword')->name('password.update');
	
	Route::resource('post', 'PostController');

	Route::get('/favourite', 'FavouriteController@index')->name('favourite.index');
});
