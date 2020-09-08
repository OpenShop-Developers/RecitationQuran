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

Route::group(['namespace' => 'Api' , 'prefix' => 'v1'] , function () {

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::post('reset-password', 'AuthController@resetPassword');
Route::post('new-password', 'AuthController@newPassword');
Route::post('register-token', 'AuthController@registerToken');

Route::group(['middleware' => 'auth:api'], function (){
    Route::post('profile', 'AuthController@profile');
    Route::post('change-password', 'AuthController@changePassword');
    Route::post('review', 'MainController@review');
    Route::get('list-of-reviews', 'MainController@reviewList');
    Route::get('list-of-admins', 'MainController@showAllAdmins');
    Route::get('filter-admins', 'MainController@filterAdmins');
    Route::post('contact-messages', 'MainController@contactMessages');
    Route::post('contact-audio', 'MainController@contactAudio');
    Route::get('message_reply', 'MainController@messageReply');
    Route::get('admin-profile', 'MainController@adminProfile');
    Route::get('list-of-notifications', 'MainController@notificationList');
    Route::post('notification-update', 'MainController@notificationUpdate');
    Route::post('remove-token', 'AuthController@removeToken');

});




});
