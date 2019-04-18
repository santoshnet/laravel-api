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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();

});

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'Api\AuthController@details');
    Route::get('logout', 'Api\AuthController@logout');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'password'
], function () {
    Route::post('create', 'Api\PasswordResetController@create');
    Route::get('find/{token}', 'Api\PasswordResetController@find');
    Route::post('reset', 'Api\PasswordResetController@reset');
});

Route::post('login', 'Api\AuthController@login');
Route::post('register', 'Api\AuthController@register');
 
Route::get('blogs','Api\BlogController@index');
Route::post('blog','Api\BlogController@store');
Route::get('blogs/{id}','Api\BlogController@show');
Route::put('blogs/{id}','Api\BlogController@update');
Route::delete('blogs/{id}','Api\BlogController@destroy');