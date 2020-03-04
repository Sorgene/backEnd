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

Route::get('/', 'FrontController@index');
Route::get('/news', 'FrontController@news');
Route::get('/login', 'LoginController@login');

Route::get('test/{id}', 'FrontController@test');

Auth::routes();

Route::group(['middleware' => ['auth'], 'prefix' => '/home'], function () {
    // 首頁
    Route::get('/', 'HomeController@index');

    // 最新消息管理
    Route::get('/news', 'NewsController@index');//首頁

    Route::post('/news/store', 'NewsController@store');//新增
    Route::get('/news/create', 'NewsController@create');//修改讀取

    Route::get('/news/edit/{id}', 'NewsController@edit');//修改編輯
    Route::post('/news/update/{id}', 'NewsController@update');//新增

    //刪除暴力方式
    Route::get('/news/delete/{id}', 'NewsController@delete');

    //Route::post('/news/delete/{id}', 'NewsController@delete');
});
