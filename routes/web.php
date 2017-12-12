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
// controller way
Route::get('/', 'PagesController@index');

Route::get('/games', 'PagesController@games');

Route::view('/laravel', 'welcome');

/* return view way
Route::get('/', function() {
	return view('pages.index');
});*/

/* variables in url
Route::get('/users/{id}', function($id) {
    return 'This is user '.$id;
});
*/
Route::resource('posts', 'PostsController');
Auth::routes();

Route::get('/dashboard', 'HomeController@index');



