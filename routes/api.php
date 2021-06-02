<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/register', 'App\Http\Controllers\API\authController@register');
Route::post('/login', 'App\Http\Controllers\API\authController@login')->name('login');

Route::post('link/create', 'App\Http\Controllers\API\shortnerController@create')->middleware('auth:api');