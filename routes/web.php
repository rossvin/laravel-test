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
    return view('welcome');
});
//Route::get('auth/register', 'Auth\RegisterController');
//Route::post('auth/register', 'Auth\RegisterController');
//Route::get('/register', 'Auth\RegisterController@index');
//Route::post('/register', 'Auth\RegisterController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@postHandler');