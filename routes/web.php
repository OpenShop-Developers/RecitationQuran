<?php

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

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes(['register' => false, 'confirm' => false]);


Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard', 'middleware' => ['auth', 'auto-check-permission'] ], function (){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('clients', 'ClientController');
    Route::post('change_password', 'ClientController@changePassword')->name('client.change-password');
    Route::resource('records', 'RecordController')->only(['index', 'destroy']);
    Route::resource('reviews', 'ReviewController')->only(['index', 'destroy']);
    Route::resource('contacts', 'ContactController')->except(['create', 'store', 'show']);
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');
    Route::post('user/change-user-password', 'UserController@changeUserPassword')->name('user.change-password');
    Route::get('user/change-password' , 'UserController@changePassword')->name('users.change_password');
    Route::post('user/update-password' , 'UserController@updatePassword')->name('users.update_password');

    //search
    Route::get('client/filter' , 'ClientController@filter')->name('clients.filter');
    Route::get('record/filter' , 'RecordController@filter')->name('records.filter');
    Route::get('review/filter' , 'ReviewController@filter')->name('reviews.filter');
    Route::get('contact/filter' , 'ContactController@filter')->name('contacts.filter');
    Route::get('user/filter' , 'UserController@filter')->name('users.filter');


});

