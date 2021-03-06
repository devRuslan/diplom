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

Route::get('/',            'HomeController@index')->name('home');
Route::get('about',        'HomeController@about')->name('about');
Route::get('courses',      'HomeController@courses')->name('courses');
Route::get('team',         'HomeController@team')->name('team');
Route::get('repertoire',   'HomeController@repertoire')->name('repertoire');
Route::get('blogs',        'HomeController@blogs')->name('blogs');
Route::get('blogs/{id}',   'HomeController@blog')->name('blog');
Route::get('contact',      'HomeController@contact')->name('contact');
Route::post('send-mail',   'HomeController@sendMail')->name('send-mail');

Route::group([
    'middleware'    => 'admin',
    'prefix'        => 'admin',
    'namespace'     => 'Admin',
    'as'            => 'admin.'
], function () {

    Route::get('/', 'HomeController@index')->name('home');


    Route::resource('company',      'CompaniesController')->only('index', 'update');
    Route::resource('homework',     'HomeworkController');
    Route::resource('user',         'UsersController')->except('show');
    Route::resource('group',        'GroupsController')->except('show');
    Route::resource('lesson',       'LessonsController')->except('show');
    Route::resource('repertoire',   'RepertoireController')->except('show');
    Route::resource('course',       'CourseController')->only('index', 'edit', 'update');


    Route::group(['prefix' => 'search', 'as' => 'search.'], function () {
        Route::post('users',    'HomeController@user_search')->name('users');
    });

    Route::group(['prefix' => 'api', 'as' => 'api.'], function () {
        Route::post('get-rooms',     'HomeController@lesson_room')->name('lesson_date');
        Route::post('kpi',           'HomeController@kpi');
        Route::apiResource('users',  'Api\UsersController')->except('store', 'index', 'update');
    });
});

Route::get('runtest', function () {
    return 'good mood';
});

Auth::routes();
