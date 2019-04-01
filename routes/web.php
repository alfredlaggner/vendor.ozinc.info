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

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', array('as' => 'reports', 'uses' => 'ReportController@index'));
Route::post('view_report', array('as' => 'view_report', 'uses' => 'ReportController@displaySalesMargins'));
Route::get('go-home', array('as' => 'go-home', 'uses' => 'ReportController@index'));
