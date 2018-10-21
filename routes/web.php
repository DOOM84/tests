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
    Route::resource('/admin/groups', 'GroupController');
    Route::resource('/admin/institutes', 'InstituteController');
    Route::resource('/admin/branches', 'BranchController');
    Route::get('/admin/deleteAnswer/{id}', 'TaskController@deleteAnswer')->name('admin.deleteAnswer');
    Route::get('/admin/stats', 'StatsController@index')->name('admin.stats');
    Route::get('/admin/stats/graph/student/{user}', 'StatsController@graphStud')->name('admin.stats.graph.student');
    Route::get('/admin/stats/graph/group/{group}', 'StatsController@graphGroup')->name('admin.stats.graph.group');
    Route::get('/admin/stats/student/{user}', 'StatsController@student')->name('admin.stats.student');
    Route::get('/admin/stats/group/{group}', 'StatsController@group')->name('admin.stats.group');
    Route::get('/admin/stats/show/{result}', 'StatsController@show')->name('admin.stats.show');
    Route::get('/admin/stats/student/detail/{result}', 'StatsController@detail')->name('admin.stats.student.detail');
    Route::post('/admin/stats/{user}/graphStudByDate', 'StatsController@graphStudByDate')->name('admin.stats.graphStudByDate');
    Route::post('/admin/stats/{group}/graphGroupByDate', 'StatsController@graphGroupByDate')->name('admin.stats.graphGroupByDate');
});


Route::group(['namespace' => 'User', 'middleware'=>'cookie'], function () {

    Route::get('/', 'HomeController@index')->name('user.index');
    Route::any('/tasks/', 'TaskController@index')->name('user.tasks')->middleware('restrictToGuest');
    Route::post('/getResult', 'TaskController@getResult')->name('getResult')->middleware('restrictToGuest');
    Route::post('/getMes', 'TaskController@getMes')->name('getMes')->middleware('restrictToGuest');

    Route::prefix('stats')->group(function () {
        Route::get('/', 'StatsController@index')->name('user.stats');
        Route::get('/group', 'StatsController@group')->name('user.stats.group');
        Route::get('/detail/{result}', 'StatsController@detail')->name('user.stats.detail')->middleware('restrictToGuest');
        Route::get('/show/{result}', 'StatsController@show')->name('user.stats.show')->middleware('restrictToGuest');
        Route::get('/graph/student', 'StatsController@graphStud')->name('user.stats.graph.student')->middleware('restrictToGuest');
        Route::get('/graph/group', 'StatsController@graphGroup')->name('user.stats.graph.group')->middleware('restrictToGuest');
        Route::post('/graphStudByDate', 'StatsController@graphStudByDate')->name('user.stats.graphStudByDate');
        Route::post('/graphGroupByDate', 'StatsController@graphGroupByDate')->name('user.stats.graphGroupByDate');
        Route::post('/sendTable', 'MailController@sendTable')->name('user.sendTable');
        Route::get('/lang/{lang}', 'HomeController@setLocale')->name('user.setLocale');
    });



});

Auth::routes();

Route::get('/home', 'User\HomeController@index')->name('home');
