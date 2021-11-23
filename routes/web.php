<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;


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




Route::get('/next','App\Http\Controllers\Controller@getNext');
Route::post('/next','App\Http\Controllers\Controller@postNext')->name('next');


Route::get('/index', 'App\Http\Controllers\Controller@index')->name('index');
Route::get('/listAccount', 'App\Http\Controllers\Controller@listAccount')->name('listAccount');
Route::get('/checkTable', 'App\Http\Controllers\Controller@checkTable')->name('checkTable');
Route::get('/checkDate', 'App\Http\Controllers\Controller@checkDate')->name('checkDate')->name('checkDate');

Route::get('/','App\Http\Controllers\DangNhapController@index');
// Route::post('/dangnhap','App\Http\Controllers\DangNhapController@postLogin')->name('dangnhap');
Route::get('/callback', 'App\Http\Controllers\Controller@callback');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
