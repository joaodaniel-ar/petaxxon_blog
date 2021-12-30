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

Route::group(['middleware'=>'auth'],function(){
    Route::post('createpost','PostController@createpost');
    Route::put('updatepost/{postid}','PostController@updatepost');
    Route::delete('deletepost/{postid}','PostController@deletepost');
});

Route::get('getposts','PostController@getposts');

Route::post('register','UserController@register');
Route::post('login','UserController@login');