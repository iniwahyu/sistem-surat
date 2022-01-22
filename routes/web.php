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

/**
 * MASTER
 */
// Role
Route::get('/master/role/get-data', 'Master\Role@getData');
Route::resource('/master/role', 'Master\Role');

/**
 * OTHER
 */
// User
Route::get('/user/get-data', 'User@getData');
Route::resource('/user', 'User');

Route::get('/', function () {
    return view('welcome');
});
