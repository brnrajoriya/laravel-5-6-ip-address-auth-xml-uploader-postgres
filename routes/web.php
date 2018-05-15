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

Route::group(['middleware' => 'ip.auth'], function () {     
    Auth::routes();
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/admin', 'AdminController@index')->name('admin');
    Route::get('/admin/xmls', 'AdminController@xmlList')->name('admin.xmls');
    Route::post('/admin/xmls/refresh', 'AdminController@xmlRefresh')->name('admin.xmls.refresh');
    Route::get('/admin/ips', 'AdminController@ipList')->name('admin.ips');
    Route::post('/admin/ips/add', 'AdminController@storeIp')->name('admin.ips.add');
    Route::delete('/admin/ips/{id}', 'AdminController@deleteIp')->name('admin.ips.delete');
});
