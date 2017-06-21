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

Route::get('/', 'profilePanel@index')->name('home');

Auth::routes();
Route::prefix('search')->group(function (){
    Route::get('buyprepaid', 'HistoryPanel@_searchHistory')->middleware('auth');
});

Route::resource('users', 'UserController');

Route::resource('roles', 'RoleController');

Route::resource('permissions', 'PermissionController');

Route::resource('posts', 'PostController');

Route::resource('profile', 'profilePanel');

Route::get('history','HistoryPanel@index');

Route::get('history/q','HistoryPanel@_searchHistory');

Route::get('history-recharge', 'HistoryPanel@_getBasicInfo')->middleware('auth');

Route::get('recharge-buyprepaid', 'RechargePanel@_getBasicInfo')->middleware('auth');

Route::get('recharge-money', 'RechargePanel@_getBasicInfo')->middleware('auth');

Route::get('guide-api', 'GuidePanel@_getBasicInfo');

Route::get('guide-recharge', 'GuidePanel@_getBasicInfo');
