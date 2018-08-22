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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::group(['namespace' => 'User'], function () {

    Route::get('/', 'HomeController@index')->name('user.index');
    /*Route::get('/about', 'AboutController@index')->name('about');
    Route::any('/category/{category}', 'CategoryController@index')->name('category');
    Route::get('/cooperation', 'CooperationController@index')->name('cooperation');
    Route::get('/delivery', 'DeliveryController@index')->name('delivery');
    Route::get('/contact/{product?}', 'ContactController@index')->name('contact');
    Route::get('/payment', 'PaymentController@index')->name('payment');
    Route::get('/product/{product}', 'ProductController@index')->name('product');
    Route::get('/search','SearchController@search')->name('search');
    Route::post('/sendMail/{slug?}', 'MailController@sendToAdmin')->name('sendToAdmin');
    Route::get('/sendnew', 'MailController@sendUpdates')->name('sendUpdates')->middleware('admin');
    Route::get('/regsubscr', 'MailController@regsubscr')->name('regsubscr');
    Route::get('/regunsubscr', 'MailController@regunsubscr')->name('regunsubscr');
    Route::get('/unsubscr/{email}', 'MailController@unsubscr')->name('unsubscr');
    Route::post('/subscr', 'MailController@subscr')->name('subscr');
    Route::post('/ajaxxrate', 'ProductController@ajaxxrate')->name('ajaxxrate');
    Route::get('/checkout', 'ProductController@checkout')->name('checkout');
    Route::any('/getfilteredcat', 'CategoryController@getFiltered')->name('getFilteredCat');
    Route::get('/check', 'ProductController@check')->name('check');
    Route::post('/formorder', 'ProductController@formorder')->name('formorder');*/


});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
