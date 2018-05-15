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

Route::group(['namespace' => 'Auth'], function () {
    Route::get('logout', 'LogoutController@logout');
});

//Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'role:admin']], function () {
Route::group(['namespace' => 'Admin', 'middleware' => ['auth', 'role:admin|employees']], function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    // Category
    Route::group(['prefix' => 'category'], function () {
        Route::get('index', 'CategoryController@index')->name('category.index');
        Route::get('add', 'CategoryController@form_add')->name('category.add.form');
        Route::post('add', 'CategoryController@add')->name('category.add');
        Route::get('edit/{id}', 'CategoryController@form_edit')->name('category.edit.form');
        Route::put('edit/{id}', 'CategoryController@edit')->name('category.edit');
        Route::delete('delete{id}', 'CategoryController@delete')->name('category.delete');
    });

    // Coupon
    Route::group(['prefix' => 'coupon', 'middleware' => ['role:admin']], function () {
        Route::get('index', 'CouponController@index')->name('coupon.index');
        Route::get('add', 'CouponController@form_add')->name('coupon.add.form');
        Route::post('add', 'CouponController@add')->name('coupon.add');
    });


    // table
    Route::group(['prefix' => 'table'], function () {
        Route::get('index', 'TablePositionController@index')->name('table.index');
        Route::get('add', 'TablePositionController@form_add')->name('table.add.form');
        Route::post('add', 'TablePositionController@add')->name('table.add');
        Route::get('edit/{id}', 'TablePositionController@form_edit')->name('table.edit.form');
        Route::put('edit/{id}', 'TablePositionController@edit')->name('table.edit');
        Route::delete('delete{id}', 'TablePositionController@delete')->name('table.delete');
    });


    // raw
    Route::group(['prefix' => 'raw'], function () {
        Route::get('index', 'RawController@index')->name('raw.index');
        Route::get('add', 'RawController@form_add')->name('raw.add.form');
        Route::post('add', 'RawController@add')->name('raw.add');
        Route::get('edit/{id}', 'RawController@form_edit')->name('raw.edit.form');
        Route::put('edit/{id}', 'RawController@edit')->name('raw.edit');
        Route::delete('delete{id}', 'RawController@delete')->name('raw.delete');
    });


    // product
    Route::group(['prefix' => 'product'], function () {
        Route::get('index', 'ProductController@index')->name('product.index');
        Route::get('add', 'ProductController@form_add')->name('product.add.form');
        Route::post('add', 'ProductController@add')->name('product.add');
        Route::get('edit/{id}', 'ProductController@form_edit')->name('product.edit.form');
        Route::put('edit/{id}', 'ProductController@edit')->name('product.edit');
        Route::delete('delete/{id}', 'ProductController@delete')->name('product.delete');
        Route::get('detail/{id}', 'ProductController@detail')->name('product.detail');
    });

    // user
    Route::group(['prefix' => 'user', 'middleware' => ['role:admin']], function () {
        Route::get('index', 'UserController@index')->name('user.index');
        Route::get('add', 'UserController@form_add')->name('user.add.form');
        Route::post('add', 'UserController@add')->name('user.add');
        Route::get('edit/{id}', 'UserController@form_edit')->name('user.edit.form');
        Route::put('edit/{id}', 'UserController@edit')->name('user.edit');
        Route::delete('delete/{id}', 'UserController@delete')->name('user.delete');
    });


    // salary
    Route::group(['prefix' => 'salary', 'middleware' => ['role:admin']], function () {
        Route::get('index', 'SalaryController@index')->name('salary.index');
        Route::get('add', 'SalaryController@form_add')->name('salary.add.form');
        Route::post('add', 'SalaryController@add')->name('salary.add');
        Route::get('edit/{id}', 'SalaryController@form_edit')->name('salary.edit.form');
        Route::put('edit/{id}', 'SalaryController@edit')->name('salary.edit');
        Route::delete('delete/{id}', 'SalaryController@delete')->name('salary.delete');
    });
    // time keeping
    Route::group(['prefix' => 'time-keeping', 'middleware' => ['role:admin']], function () {
        Route::get('index', 'TimeKeepingController@index')->name('time-keeping.index');
        Route::get('add', 'TimeKeepingController@form_add')->name('time-keeping.add.form');
        Route::post('add', 'TimeKeepingController@add')->name('time-keeping.add');
        Route::get('detail/{user_id}', 'TimeKeepingController@detail')->name('time-keeping.detail');
    });

    // order
    Route::group(['prefix' => 'order'], function () {
        Route::get('index', 'OrderController@index')->name('order.index');
        Route::get('add', 'OrderController@form_add')->name('order.form_add');
        Route::post('add', 'OrderController@add')->name('order.add');

        Route::get('merge/{id}', 'OrderController@form_merge')->name('order.form_merge');
        Route::get('print-order/{id}', 'OrderController@printOrder')->name('order.printOrder');
        Route::post('merge', 'OrderController@merge')->name('order.merge');


        Route::get('add-menu/{id}', 'OrderController@menu_form')->name('order.menu_form');
        Route::post('add-menu', 'OrderController@menu')->name('order.menu');

        Route::get('edit/{id}', 'OrderController@form_edit')->name('order.edit.form');
        Route::put('edit/{id}', 'OrderController@edit')->name('order.edit');
    });


    // pay salary
    Route::group(['prefix' => 'pay-salary', 'middleware' => ['auth', 'role:admin']], function () {
        Route::get('index', 'PaySalaryController@index')->name('pay-salary.index');
        Route::get('change-type/{id}', 'PaySalaryController@update')->name('pay-salary.update');
        Route::get('add', 'PaySalaryController@form_add')->name('pay-salary.form_add');
        Route::post('add', 'PaySalaryController@add')->name('pay-salary.add');
    });

    Route::get('/dang-nhap',     ['as' => 'member.login' ,'uses' => 'Member\MemberController@showLoginForm']);
    Route::post('/dang-nhap',     ['as' => 'member.login.submit' ,'uses' => 'Member\MemberController@login']);
    Route::get('/dang-ky',       ['as'  => 'member.register' ,      'uses' =>'Member\MemberController@getRegister']);
    Route::post('/dang-ky',       ['as'  => 'member.register.submit' ,      'uses' =>'Member\MemberController@postRegister']);

    // statis
    Route::group(['prefix' => 'statis', 'middleware' => ['auth', 'role:admin']], function () {
        Route::get('index', 'StatiscalController@index')->name('statis.index');
    });


    Route::get('cart/{id}', 'CartController@cart')->name('cart.product');
    Route::get('all-cart', 'CartController@all_cart')->name('all_cart.product');
    Route::get('delete-cart/{rowId}', 'CartController@delete')->name('cart_delete');
    Route::put('update-cart/{rowId}', 'CartController@update')->name('cart_update');
    Route::post('customer-order', 'CartController@order')->name('cart_order');

//    });


});
//
//Route::get('/', 'IndexController@index')->name('frontend.index');
//Route::get('detail/{id}', 'IndexController@detail')->name('frontend.index.detail');
//
//
//
//Route::get('book-service/{id}', 'ServiceOrderController@index')->name('book.service');
//Route::post('book-service/{id}', 'ServiceOrderController@add')->name('book.service.add');
//
//
//
//Route::get('about', 'IndexController@about')->name('frontend_about');
//Route::get('contact', 'IndexController@contact')->name('frontend_contact');




Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

