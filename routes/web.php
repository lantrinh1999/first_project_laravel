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
Route::any('/ckfinder/examples/{example?}', 'CKSource\CKFinderBridge\Controller\CKFinderController@examplesAction')
    ->name('ckfinder_examples');
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    // đăng nhập
    Route::get('login', 'Auth\LoginController@login')->name('login');
    Route::get('/', 'AdminController@index')->name('home');
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    Route::post('postLogin', 'Auth\LoginController@postLogin')->name('postLogin');
    // Đăng kí
    Route::get('signup', 'AdminController@signup')->name('signup');
    Route::post('postSignup', 'AdminController@postSignup')->name('postSignup');
    // Home
    Route::get('home', 'AdminController@index')->name('home');

    // Sản phẩm
    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('list', 'ProductController@index')->name('list');
        Route::get('data', 'ProductController@productsList')->name('data');
        // them moi
        Route::get('add', 'ProductController@add')->name('add');
        Route::any('saveAdd', 'ProductController@saveAdd')->name('saveAdd');
        // sua
        Route::get('edit/{id}', 'ProductController@edit')->name('edit');
        Route::any('saveEdit', 'ProductController@saveEdit')->name('saveEdit');
        // chi tiet
        Route::any('detail/{id}', 'ProductController@detail')->name('detail');
        Route::any('postComment', 'ProductController@postComment')->name('postComment');
        // del
        Route::get('delete/{id}', 'ProductController@delete')->name('delete');
    });

    // danh mục
    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('list', 'CategoryController@index')->name('list');
        Route::get('data', 'CategoryController@listCategries')->name('data');
        // them moi
        Route::get('add', 'CategoryController@add')->name('add');
        Route::any('saveAdd', 'CategoryController@saveAdd')->name('saveAdd');
        // sua
        Route::get('edit/{id}', 'CategoryController@edit')->name('edit');
        Route::any('saveEdit', 'CategoryController@saveEdit')->name('saveEdit');
        // chi tiet
        Route::any('detail/{id}', 'CategoryController@detail')->name('detail');
        Route::any('postComment', 'CategoryController@postComment')->name('postComment');
        // del
        Route::get('delete/{id}', 'CategoryController@delete')->name('delete');
    });

    // User
    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        // list
        Route::get('list', 'UserController@index')->name('list');
        // add
        Route::get('add', 'UserController@add')->name('add');
        Route::any('saveAdd', 'UserController@saveAdd')->name('saveAdd');
        // edit
        Route::get('edit/{id}', 'UserController@edit')->name('edit');
        Route::any('saveEdit', 'UserController@saveEdit')->name('saveEdit');
        // del
        Route::get('delete/{id}', 'UserController@delete')->name('delete');
    });

    // Comment
    Route::group(['prefix' => 'comment', 'as' => 'comment.'], function () {
        Route::get('list', 'CommentController@index')->name('list');
        Route::get('delete/{id}', 'CommentController@delete')->name('delete');
    });
    /////////////////////
});
