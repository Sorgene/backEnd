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

Route::get('/', 'FrontController@index');//首頁

Route::get('/news', 'FrontController@news');// 最新消息
Route::get('/news/{id}', 'FrontController@news_detail');// 最新消息detail

Route::get('/login', 'LoginController@login');//登入頁

Route::get('test/{id}', 'FrontController@test');

Auth::routes();

Route::group(['middleware' => ['auth'], 'prefix' => '/home'], function () {
    // 首頁
    Route::get('/', 'HomeController@index');

    // 最新消息管理
    Route::get('/news', 'NewsController@index');//首頁


    Route::post('/news/store', 'NewsController@store');//儲存
    Route::get('/news/create', 'NewsController@create');//新增

    Route::get('/news/edit/{id}', 'NewsController@edit');//編輯
    Route::post('/news/update/{id}', 'NewsController@update');//更新
    Route::post('/news/delete/{id}', 'NewsController@delete');//刪除暴力方式


});
