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
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function() {

    Route::resources([
        'crits' => 'CritController',
        'groups' => 'GroupController',
        'groupmemberships' => 'GroupMembershipController',
        'pages' => 'PageController',
        'pastes' => 'PasteController',
        'uploads' => 'UploadController',
        'users' => 'UserController'
    ]);
    Route::get('/uploads/{upload}/delete', 'UploadController@confirmDelete');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::view('/public/escaper', 'escaper')->name('escaper');