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
 * AUTH
 */
Route::get('/login', 'Auth@login');
Route::post('/login-proses', 'Auth@loginProses');
Route::get('/logout', 'Auth@logout');

/**
 * MASTER
 */
// Role
Route::get('/master/role/get-data', 'Master\Role@getData');
Route::resource('/master/role', 'Master\Role');

// Jenis Surat
Route::get('/master/jenis/get-data', 'Master\Jenis@getData');
Route::resource('/master/jenis', 'Master\Jenis');

// Asal Surat
Route::get('/master/asal/get-data', 'Master\Asal@getData');
Route::resource('/master/asal', 'Master\Asal');

// Disposisi
Route::get('/master/disposisi/get-data', 'Master\Disposisi@getData');
Route::resource('/master/disposisi', 'Master\Disposisi');

/**
 * OTHER
 */
// User
Route::get('/user/get-data', 'User@getData');
Route::resource('/user', 'User');

Route::get('/', function () {
    return view('welcome');
});
