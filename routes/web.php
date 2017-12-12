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
/* return controller way
Route::get('/', 'PagesController@index');
*/
/* return view way
Route::get('/', function() {
	return view('pages.index');
});*/

/* variables in url
Route::get('/users/{id}', function($id) {
    return 'This is user '.$id;
});
*/

// Home
Route::get('/', 'PagesController@index');

// Games
Route::get('/games', 'PagesController@games');

Route::get('/tic-tac-toe', function() {
    return view('pages.games.tictactoe');
});

// About Laravel
Route::view('/laravel', 'welcome');


Route::resource('posts', 'PostsController');
Auth::routes();

Route::get('/dashboard', 'HomeController@index');



