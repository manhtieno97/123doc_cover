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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','GetCoverController@index')->name('getform');
Route::post('/','GetCoverController@postCover')->name('postCover');
Route::get('detail/{id}', 'GetCoverController@detail')->name('detail');

Route::get('/image', 'ImagickController@index')->name('getFormImage');
Route::post('/image', 'ImagickController@postImage')->name('postImage');
Route::get('/image/detail/{id}', 'ImagickController@detailImage')->name('detailImage');
