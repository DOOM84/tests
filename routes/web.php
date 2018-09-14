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
Route::group(['namespace' => 'Admin', 'middleware'=>'admin'], function () {

    Route::get('/admin/home', 'HomeController@index')->name('admin.home');
    Route::resource('/admin/answers', 'AnswerController');
    Route::resource('/admin/categories', 'CategoryController');
    Route::resource('/admin/levels', 'LevelController');
    Route::resource('/admin/tasks', 'TaskController');
    Route::resource('/admin/users', 'UserController');
    Route::resource('/admin/topics', 'TopicController');
    Route::get('/admin/deleteAnswer/{id}', 'TaskController@deleteAnswer')->name('admin.deleteAnswer');
});


Route::group(['namespace' => 'User'], function () {

    Route::get('/', 'HomeController@index')->name('user.index');
    Route::get('/tasks/', 'TaskController@index')->name('user.tasks')->middleware('restrictToGuest');
    Route::post('/getResult', 'TaskController@getResult')->name('getResult')->middleware('restrictToGuest');;


});

Auth::routes();

Route::get('/home', 'User\HomeController@index')->name('home');
