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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/roles', 'HomeController@roles')->name('roles');

Route::get('/addposts', 'HomeController@addposts')->name('addposts');

Route::get('/posts', 'HomeController@posts')->name('posts');

Route::get('/getpermission/{id}', 'HomeController@getpermission')->name('getpermission');

Route::post('/addPermission', 'HomeController@addPermission')->name('addPermission');

Route::post('/createpost', 'HomeController@createpost')->name('createpost');

Route::get('/editpost/{id}', 'HomeController@editpost')->name('editpost');

Route::get('/post/{id}', 'HomeController@post')->name('post');

Route::get('/delete/{id}', 'HomeController@delete')->name('delete');

Route::get('/users', 'HomeController@users')->name('users');