<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('test', function() {
	return View::make('test');
});

// Public Page
Route::get('/', 
	array(
		'as' => 'home.index',
		'uses' => 'HomeController@getIndex'
	));
Route::get('shop', 
	array(
		'as' => 'home.shop',
		'uses' => 'HomeController@getShop'
	));

// Store Route
Route::get('thumbnail', 'ImagesController@getThumbnail');
Route::get('option', 'HomeController@getExtra');
Route::get('element', 'HomeController@getElement');
Route::get('search', 'HomeController@getSearch');

// Confide routes
Route::get('users/create', 'UsersController@create');
Route::post('users', 'UsersController@store');
Route::get('users/login', 'UsersController@login');
Route::post('users/login', 'UsersController@doLogin');
Route::get('users/confirm/{code}', 'UsersController@confirm');
Route::get('users/forgot_password', 'UsersController@forgotPassword');
Route::post('users/forgot_password', 'UsersController@doForgotPassword');
Route::get('users/reset_password/{token}', 'UsersController@resetPassword');
Route::post('users/reset_password', 'UsersController@doResetPassword');
Route::get('users/logout', 'UsersController@logout');

/* Dashboard route */

Route::group([
	'prefix' => 'dashboard',
	'before' => 'auth'

], function() {

	// Dashboard main page

	Route::get('/', array('uses' => 'DashboardController@getIndex',
		   				  'as' => 'dashboard.index'));
	// Category route
	Route::controller(
		'category',
		'CategoriesController',
		array(
			'getIndex' => 'category.index',
			'getCreate' => 'category.create',
			'postCreate' => 'category.store',
			'getEdit' => 'category.edit',
			'postEdit' => 'category.update',
			'getShow' => 'category.show',
			'getDelete' => 'category.delete',
			'getNode' => 'category.node'
		)
	);

	// Product route
	Route::controller(
		'product',
		'ProductsController',
		array(
			'getIndex' => 'product.index',
			'getCreate' => 'product.create',
			'postCreate' => 'product.store',
			'getEdit' => 'product.edit',
			'postEdit' => 'product.update',
			'getShow' => 'product.show',
			'getDelete' => 'product.delete'
		)
	);

	// Property image route
	Route::controller(
		'image',
		'ImagesController',
		array(
			'postUpload' => 'image.upload',
			'getThumbnail' => 'image.thumbnail',
			'postDelete' => 'image.delete'
		)
	);

	// Gallery route
	Route::controller(
		'gallery',
		'GalleriesController',
		array(
			'getIndex' => 'gallery.index',
			'getCreate' => 'gallery.create',
			'postCreate' => 'gallery.store'
		)
	);

});
