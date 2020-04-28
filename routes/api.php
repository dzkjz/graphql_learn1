<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|php
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('articles', 'ArticleController');

Route::post('login', 'Api\Auth\AuthController@login')->middleware('guest')->name('login.api');
Route::post('logout', 'Api\Auth\AuthController@logout')->middleware('auth:api')->name('logout.api');
Route::post('refresh', 'Api\Auth\AuthController@refresh')->middleware('auth:api')->name('refresh.api');
Route::post('register', 'Api\Auth\AuthController@register')->middleware('guest')->name('register.api');
Route::get('me', 'Api\Auth\AuthController@me')->middleware('auth:api');

