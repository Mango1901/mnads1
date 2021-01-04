<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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


Auth::routes(['verify' => true]);

Route::get('', 'Admin\AdminController@Home');
Route::get('/login', 'Admin\AdminController@login')->name("login");
Route::get('/forgot-password', 'Admin\AdminController@forgotpassword')->name('forgot.password');
Route::get('/register', 'Admin\AdminController@register')->name("register");
Route::post('/create', 'Admin\AdminController@create');
Route::post('/sent', 'Admin\AdminController@sent');
Route::post('/execlogin', 'Admin\AdminController@execlogin');
Route::get('/extend-date-view', 'Admin\AdminController@extend_date_view')->name('extend.date.view');
Route::post('/extend-date', 'Admin\AdminController@extend_date')->name('extend.date');
Route::get('/reset-password', 'Admin\AdminController@reset_password')->name('reset.password');
Route::post('/reset-password-save', 'Admin\AdminController@reset_password_save')->name('reset.password.save');


//language
Route::group(['prefix'=>'language','as'=>'language.'], function() {
    Route::get('{language}',['as'=>'index','uses'=>'Admin\LanguageController@index']);
});
//facebook-login
Route::get('/login-facebook', 'Admin\SocialController@login_facebook');
Route::get('/callback/facebook', 'Admin\SocialController@callback_facebook');
//google-login
Route::get('/login-google','Admin\SocialController@login_google');
Route::get('/google/callback','Admin\SocialController@callback_google');
///backend
Route::group(['middleware' => ['checkAdminLogin','verified'], 'prefix' => '', 'namespace' => 'Admin'], function() {

	Route::get('/dashboard', 'ChartController@index');
	//user
    Route::group(['prefix'=>'user','as'=>'user.'], function(){
        Route::get('profile',['as'=>'profile','uses'=>'UserController@profile']);
        Route::get('create',['as'=>'create','uses'=>'UserController@create']);
        Route::get('showpassword', ['as'=>'showpassword','uses'=>'UserController@showpassword']);
        Route::post('change-password', ['as'=>'change.password','uses'=>'UserController@changepassword']);
        Route::post('update-profile', ['as'=>'update.profile','uses'=>'UserController@updateprofile']);
        Route::get('logout', ['as'=>'logout','uses'=>'UserController@logout']);
        Route::get('index', ['as'=>'index','uses'=>'UserController@index']);
        Route::post('store', ['as'=>'store','uses'=>'UserController@store']);
        Route::post('update', ['as'=>'update','uses'=>'UserController@update']);
        Route::get('edit/{id}', ['as'=>'edit','uses'=>'UserController@edit']);
        Route::get('delete/{id}', ['as'=>'delete','uses'=>'UserController@delete']);
        Route::get('change-user/{id}', ['as'=>'change.user','uses'=>'UserController@change_user']);
    });
	//call
    Route::group(['prefix'=>'call','as'=>'call.'], function(){
        Route::get('index', ['as'=>'index','uses'=>'CallController@index']);
        Route::get('create', ['as'=>'create','uses'=>'CallController@create']);
        Route::post('store', ['as'=>'store','uses'=>'CallController@store']);
        Route::post('update', ['as'=>'update','uses'=>'CallController@update']);
        Route::get('edit/{id}', ['as'=>'edit','uses'=>'CallController@edit']);
        Route::get('delete/{id}', ['as'=>'delete','uses'=>'CallController@delete']);
    });
    //chatfacebook
    Route::group(['prefix'=>'chatfacebook','as'=>'chatfacebook.'], function(){
        Route::get('index', ['as'=>'index','uses'=>'ChatFaceBookController@index']);
        Route::get('create', ['as'=>'create','uses'=>'ChatFaceBookController@create']);
        Route::post('store', ['as'=>'store','uses'=>'ChatFaceBookController@store']);
        Route::post('update', ['as'=>'update','uses'=>'ChatFaceBookController@update']);
        Route::get('edit/{id}', ['as'=>'edit','uses'=>'ChatFaceBookController@edit']);
        Route::get('delete/{id}', ['as'=>'delete','uses'=>'ChatFaceBookController@delete']);
    });
    //chatzalo
    Route::group(['prefix'=>'chatzalo','as'=>'chatzalo.'], function(){
        Route::get('index', ['as'=>'index','uses'=>'ChatZaloController@index']);
        Route::get('create', ['as'=>'create','uses'=>'ChatZaloController@create']);
        Route::post('store', ['as'=>'store','uses'=>'ChatZaloController@store']);
        Route::post('update', ['as'=>'update','uses'=>'ChatZaloController@update']);
        Route::get('edit/{id}', ['as'=>'edit','uses'=>'ChatZaloController@edit']);
        Route::get('delete/{id}', ['as'=>'delete','uses'=>'ChatZaloController@delete']);
    });
    //contact
    Route::group(['prefix'=>'contact','as'=>'contact.'], function(){
        Route::get('index', ['as'=>'index','uses'=>'ContactController@index']);
        Route::get('create', ['as'=>'create','uses'=>'ContactController@create']);
        Route::post('store', ['as'=>'store','uses'=>'ContactController@store']);
        Route::post('update', ['as'=>'update','uses'=>'ContactController@update']);
        Route::get('edit/{id}', ['as'=>'edit','uses'=>'ContactController@edit']);
        Route::get('delete/{id}', ['as'=>'delete','uses'=>'ContactController@delete']);
    });
    //maps
    Route::group(['prefix'=>'maps','as'=>'maps.'], function(){
        Route::get('index', ['as'=>'index','uses'=>'MapsController@index']);
        Route::get('create', ['as'=>'create','uses'=>'MapsController@create']);
        Route::post('store', ['as'=>'store','uses'=>'MapsController@store']);
        Route::post('update', ['as'=>'update','uses'=>'MapsController@update']);
        Route::get('edit/{id}', ['as'=>'edit','uses'=>'MapsController@edit']);
        Route::get('delete/{id}', ['as'=>'delete','uses'=>'MapsController@delete']);
    });
	//calllog
    Route::group(['prefix'=>'calllog','as'=>'calllog.'], function(){
        Route::get('index',['as'=>'index','uses'=>'CalllogController@index']);
        Route::get('index-ajax',['as'=>'index.ajax','uses'=>'CalllogController@index_ajax']);
        Route::get('download',['as'=>'download','uses'=>'CalllogController@index']);
    });
    //chatfblog
    Route::group(['prefix'=>'chatfblog','as'=>'chatfblog.'], function(){
        Route::get('index',['as'=>'index','uses'=>'ChatfblogController@index']);
        Route::get('index-ajax',['as'=>'index.ajax','uses'=>'ChatfblogController@index_ajax']);
        Route::get('download',['as'=>'download','uses'=>'ChatfblogController@index']);
    });
    //chatzalolog
    Route::group(['prefix'=>'chatzalolog','as'=>'chatzalolog.'], function(){
        Route::get('index',['as'=>'index','uses'=>'ChatzalologController@index']);
        Route::get('index-ajax',['as'=>'index.ajax','uses'=>'ChatzalologController@index_ajax']);
        Route::get('download',['as'=>'download','uses'=>'ChatzalologController@index']);
    });
    //contactlog
    Route::group(['prefix'=>'contactlog','as'=>'contactlog.'], function(){
        Route::get('index',['as'=>'index','uses'=>'ContactlogController@index']);
        Route::get('index-ajax',['as'=>'index.ajax','uses'=>'ContactlogController@index_ajax']);
        Route::get('download',['as'=>'download','uses'=>'ContactlogController@index']);
    });
    //maplog
    Route::group(['prefix'=>'maplog','as'=>'maplog.'], function(){
        Route::get('index',['as'=>'index','uses'=>'MaplogController@index']);
        Route::get('index-ajax',['as'=>'index.ajax','uses'=>'MaplogController@index_ajax']);
        Route::get('download',['as'=>'download','uses'=>'MaplogController@index']);
    });
    //chart
    Route::group(['prefix'=>'chart','as'=>'chart.'], function() {
        Route::get('index', ['as'=>'index','uses'=>'ChartController@index']);
    });
    //chat
    //    Route::get('chat/index','ChatController@index');
    //    Route::post('chat/store','ChatController@store')->name('chat.store');
    //google-ads
    Route::group(['prefix'=>'googleAds','as'=>'googleAds.'], function() {
        route::get('/index',['as'=>'index','uses'=>'GoogleAdsController@google_report_list']);
        route::get('/getAuthentication',['as'=>'get.Authentication','uses'=>'GoogleAdsController@getAuthentication']);
        route::post('/get-google-report',['as'=>'get.google.report','uses'=>'GoogleAdsController@get_google_report']);
        route::get('/delete-google-report',['as'=>'delete.google.report','uses'=>'GoogleAdsController@delete_google_report']);
        route::get('/getCampaignDetails',['as'=>'get.campaign.details','uses'=>'GoogleAdsController@getCampaignDetails']);
    });

    route::get('/oauth2callback','GoogleAdsController@Auth_save');//unique

	Route::get('{first}/{second}/{third}', 'RoutingController@thirdLevel')->name('third');
	Route::get('{first}/{second}', 'RoutingController@secondLevel')->name('second');
	Route::get('{any}', 'RoutingController@root')->name('any');

});

