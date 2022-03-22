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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('tambah-bonus', 'HomeController@create');
Route::post('/simpan-bonus', 'HomeController@store');
Route::get('edit/{id}', 'HomeController@edit');
Route::post('/update-bonus', 'HomeController@update');
Route::get('hapus-bonus', 'HomeController@hapus')->name('hapus-bonus');
Route::post('destroy-bonus', 'HomeController@destroy')->name('destroy-bonus');
Route::get('detail/{id}', 'HomeController@detail');
