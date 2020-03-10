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

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');
// Route::get('/index', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'MainController@index')->name('home');
Route::get('/{username}', 'ProfileController@index');

Route::get('/app/post', 'MainController@posts');
Route::get('/app/user', 'MainController@getUser');
/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
// Route::get('/profile', 'ProfileController@index');
//Display 
Route::get('/profile/{id}/{type}','ProfileController@display');
//Update
Route::patch('/profile/{id}/{type}','ProfileController@update');

/*
|--------------------------------------------------------------------------
| Post
|--------------------------------------------------------------------------
*/
//Create
Route::get('/post/{id}/create','PostController@create');
Route::post('/post/{id}/create','PostController@store');
//Update
Route::post('/post/{id}/edit','PostController@edit');
Route::patch('/post/{id}/update','PostController@update');
//Delete
Route::delete('/post/{id}/delete','PostController@delete');