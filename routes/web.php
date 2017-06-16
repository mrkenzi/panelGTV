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

Route::get('/', 'HomeController@index')->middleware('auth')->name('home');

Route::prefix('search')->group(function (){
    Route::get('buyprepaid', 'HistoryPanel@_searchHistory')->middleware('auth');
});

Route::prefix('admin')->group(function () {

    Route::get('profile', 'profilePanel@_getBasicInfo')->middleware('auth');

    Route::get('change-password', 'profilePanel@_getBasicInfo')->middleware('auth');

    Route::get('history-buyprepaid', 'HistoryPanel@_getTodayRequest')->middleware('auth');

    Route::get('history-recharge', 'HistoryPanel@_getBasicInfo')->middleware('auth');

    Route::get('recharge-buyprepaid', 'RechargePanel@_getBasicInfo')->middleware('auth');

    Route::get('recharge-money', 'RechargePanel@_getBasicInfo')->middleware('auth');

    Route::get('guide-api', 'GuidePanel@_getBasicInfo');

    Route::get('guide-recharge', 'GuidePanel@_getBasicInfo');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
