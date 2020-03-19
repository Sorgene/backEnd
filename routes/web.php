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

Route::get('/', 'FrontController@index'); //首頁

Route::get('/news', 'FrontController@news'); // 最新消息
Route::get('/news/{id}', 'FrontController@news_detail'); // 最新消息detail

// test
Route::get('/test', 'FrontController@test');

// 產品
Route::get('/products', 'FrontController@products'); // 產品
Route::get('/products/{id}', 'FrontController@product_detail'); //產品內容

//購物車cart
// Route::get('/product_detail', 'FrontController@product_detail'); // 選購畫面
Route::post('/add_cart/{product_id}', 'FrontController@add_cart'); // 加入購物車
Route::post('/update_cart/{product_id}','FrontController@update_cart'); //更新購物車數量
Route::get('/delete_cart/{product_id}','FrontController@delete_cart'); //刪除商品於購物車中

Route::get('/cart', 'FrontController@cart_total'); // 結帳畫面總覽
Route::get('/cart_checkout','FrontController@cart_checkout'); //結帳
Route::post('/cart_checkout','FrontController@post_cart_checkout'); //結帳


//金流測試
Route::get('/test_check_out','FrontController@test_check_out');

// 聯絡
Route::get('/contactUs', 'FrontController@contactUs');
Route::post('/contactUs/store', 'FrontController@contactstore');

Route::get('/login', 'LoginController@login'); //登入頁

Auth::routes();

Route::group(['middleware' => ['auth'], 'prefix' => '/home'], function () {
    // 首頁
    Route::get('/', 'HomeController@index');

    // 最新消息管理News
    Route::get('/news', 'NewsController@index'); //首頁

    Route::post('/news/store', 'NewsController@store'); //儲存
    Route::get('/news/create', 'NewsController@create'); //新增

    Route::get('/news/edit/{id}', 'NewsController@edit'); //編輯
    Route::post('/news/update/{id}', 'NewsController@update'); //更新
    Route::post('/news/delete/{id}', 'NewsController@delete'); //刪除暴力方式
    Route::post('ajax_delete_news_imgs', 'NewsController@ajax_delete_news_imgs');
    Route::post('ajax_post_sort', 'NewsController@ajax_post_sort');

    Route::post('ajax_upload_img', 'UploadImgController@ajax_upload_img');
    Route::post('ajax_delete_img', 'UploadImgController@ajax_delete_img');

    // 產品管理Products
    Route::get('/products', 'ProductsController@index'); //首頁

    Route::post('/products/store', 'ProductsController@store'); //儲存
    Route::get('/products/create', 'ProductsController@create'); //新增

    Route::get('/products/edit/{id}', 'ProductsController@edit'); //編輯
    Route::post('/products/update/{id}', 'ProductsController@update'); //更新
    Route::post('/products/delete/{id}', 'ProductsController@delete'); //刪除

    // 產品類型管理ProductTypes
    Route::get('/productTypes', 'ProductTypesController@index'); //首頁

    Route::post('/productTypes/store', 'ProductTypesController@store'); //儲存
    Route::get('/productTypes/create', 'ProductTypesController@create'); //新增

    Route::get('/productTypes/edit/{id}', 'ProductTypesController@edit'); //編輯
    Route::post('/productTypes/update/{id}', 'ProductTypesController@update'); //更新
    Route::post('/productTypes/delete/{id}', 'ProductTypesController@delete'); //刪除
});
