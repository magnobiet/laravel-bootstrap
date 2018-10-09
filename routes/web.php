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

Auth::routes();

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index')->name('home');

Route::resource('users', 'UsersController');
Route::resource('states', 'StatesController', ['only' => ['index', 'show']]);
Route::resource('cities', 'CitiesController', ['only' => ['index']]);
Route::resource('audits', 'AuditsController', ['only' => ['index', 'show']]);
