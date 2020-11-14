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


Route::get('', 'Admin\AdminController@login');
Route::get('/login', 'Admin\AdminController@login');
Route::get('/forgot-password', 'Admin\AdminController@forgotpassword');
Route::get('/register', 'Admin\AdminController@register');
Route::post('/create', 'Admin\AdminController@create');
Route::post('/sent', 'Admin\AdminController@sent');
Route::post('/execlogin', 'Admin\AdminController@execlogin');



///backend
Route::group(['middleware' => 'checkAdminLogin', 'prefix' => '', 'namespace' => 'Admin'], function() {

	Route::get('/dashboard', 'ChartController@index');
	Route::get('/user/profile', 'UserController@profile');
    Route::get('/user/showpassword', 'UserController@showpassword');
    Route::post('/user/changepassword', 'UserController@changepassword');
	Route::post('/user/updateprofile', 'UserController@updateprofile');
	Route::get('/user/logout', 'UserController@logout');

	//user
	Route::get('/index', 'UserController@index');
	Route::get('/user/index', 'UserController@index');
	Route::get('create', 'UserController@create');
	Route::post('user/store', 'UserController@store');
	Route::post('user/update', 'UserController@update');

	Route::get('user/edit/{id}', 'UserController@edit');
	Route::get('user/delete/{id}', 'UserController@delete');
	//admin

	//call
	Route::get('call/index', 'CallController@index');
	Route::get('call/create', 'CallController@create');
	Route::post('call/store', 'CallController@store');
	Route::post('call/update', 'CallController@update');
	Route::get('call/edit/{id}', 'CallController@edit');
	Route::get('call/delete/{id}', 'CallController@delete');

	//chatfacebook
	Route::get('chatfacebook/index', 'ChatFaceBookController@index');
	Route::get('chatfacebook/create', 'ChatFaceBookController@create');
	Route::post('chatfacebook/store', 'ChatFaceBookController@store');
	Route::post('chatfacebook/update', 'ChatFaceBookController@update');
	Route::get('chatfacebook/edit/{id}', 'ChatFaceBookController@edit');
	Route::get('chatfacebook/delete/{id}', 'ChatFaceBookController@delete');

	//chatzalo
	Route::get('chatzalo/index', 'ChatZaloController@index');
	Route::get('chatzalo/create', 'ChatZaloController@create');
	Route::post('chatzalo/store', 'ChatZaloController@store');
	Route::post('chatzalo/update', 'ChatZaloController@update');
	Route::get('chatzalo/edit/{id}', 'ChatZaloController@edit');
	Route::get('chatzalo/delete/{id}', 'ChatZaloController@delete');

	//contact
	Route::get('contact/index', 'ContactController@index');
	Route::get('contact/create', 'ContactController@create');
	Route::post('contact/store', 'ContactController@store');
	Route::post('contact/update', 'ContactController@update');
	Route::get('contact/edit/{id}', 'ContactController@edit');
	Route::get('contact/delete/{id}', 'ContactController@delete');

	//maps
	Route::get('maps/index', 'MapsController@index');
	Route::get('maps/create', 'MapsController@create');
	Route::post('maps/store', 'MapsController@store');
	Route::post('maps/update', 'MapsController@update');
	Route::get('maps/edit/{id}', 'MapsController@edit');
	Route::get('maps/delete/{id}', 'MapsController@delete');

	//calllog
    Route::get('calllog/index','CalllogController@index');
    Route::get('calllog/download','CalllogController@index');

    //chatfblog
    Route::get('chatfblog/index','ChatfblogController@index');
    Route::get('chatfblog/download','ChatfblogController@index');

    //chatzalolog
    Route::get('chatzalolog/index','ChatzalologController@index');
    Route::get('chatzalolog/download','ChatzalologController@index');

    //contactlog
    Route::get('contactlog/index','ContactlogController@index');
    Route::get('contactlog/download','ContactlogController@index');

    //maplog
    Route::get('maplog/index','MaplogController@index');
    Route::get('maplog/download','MaplogController@index');
    //chart

    Route::get('chart/index','ChartController@index');

    Route::get('chat/index','ChatController@index');
    Route::post('chat/store','ChatController@store');

    Route::get('language/{language}','LanguageController@index')->name('language.index');

    //google-ads
    route::get('/getAuthentication','GoogleAdsController@getAuthentication')->name('get.Authentication');
    route::get('/getAccessTokenRefresh','GoogleAdsController@getAccessTokenRefresh');
    route::get('/oauth2callback','GoogleAdsController@Auth_save');
    route::get('/getCampaignDetails','GoogleAdsController@getCampaignDetails')->name('get.campaign.details');
    route::get('/google-report-list','GoogleAdsController@google_report_list')->name('google.report.list');

	Route::get('{first}/{second}/{third}', 'RoutingController@thirdLevel')->name('third');
	Route::get('{first}/{second}', 'RoutingController@secondLevel')->name('second');
	Route::get('{any}', 'RoutingController@root')->name('any');

});

