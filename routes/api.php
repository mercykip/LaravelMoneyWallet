<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login','ApiController@login');
Route::post('register','ApiController@register');
Route::put('update/{id}','ApiController@upateUsers');
Route::delete('delete/{id}','ApiController@destroy');
Route::get('view','ApiController@users');
Route::get('view/{id}','ApiController@user');
Route::get('checkBalance/{id}','AccountController@checkBalance');
Route::put('withDraw/{id}','AccountController@withDraw');
Route::group(['middleware'=>'auth.jwt'], function () {
    Route::get('logout','ApiController@logout');

    Route::resource('/task','ApiController');

});

// Route::group(['middleware'=>'auth'], function () {
//     Route::resources('roles','RoleController');
//     Route::resource('account','AccountController');

//     Route::resource('users','UserController');

// });