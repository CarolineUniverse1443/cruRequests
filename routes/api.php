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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getUsers', 'App\Http\Controllers\UsersController@getUsers');

Route::get('createUser', 'App\Http\Controllers\UsersController@createUser');

Route::patch('updateUser', 'App\Http\Controllers\UsersController@updateUser');

//Route::patch('update', 'App\Http\Controllers\UpdateController@updatingUser');

Route::post('sign_up', 'App\Http\Controllers\UsersController@registerUser');
Route::post('sign_in', 'App\Http\Controllers\UsersController@signIn');

Route::post('register', 'App\Http\Controllers\UsersController@registerValidate');

