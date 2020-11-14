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

Route::post('calllog', 'ApiController@calllog');
Route::post('chatfblog', 'ApiController@chatfblog');
Route::post('chatzalolog', 'ApiController@chatzalolog');
Route::post('contactlog', 'ApiController@contactlog');
Route::post('maplog', 'ApiController@maplog');
Route::get('chartlog', 'ApiController@chart');
Route::get('getuserinfo', 'ApiController@userinfo');
Route::post('sentmessage', 'ApiController@sentmessage');
Route::post('mail', 'ApiController@mail');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
