<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();


Route::group(['prefix'  =>  'admin'], function () {
    Route::group(['middleware' => ['role:admin']], function () {



        Route::resource('roles','Admin\RoleController');
        Route::resource('users','Admin\UserController');



        Route::group(['prefix'  =>   'categories'], function() {

            Route::get('/', 'Admin\CategoryController@index')->name('admin.categories.index');
            Route::get('/create', 'Admin\CategoryController@create')->name('admin.categories.create');
            Route::post('/store', 'Admin\CategoryController@store')->name('admin.categories.store');
            Route::get('/{id}/edit', 'Admin\CategoryController@edit')->name('admin.categories.edit');
            Route::post('/update', 'Admin\CategoryController@update')->name('admin.categories.update');
            Route::get('/{id}/delete', 'Admin\CategoryController@delete')->name('admin.categories.delete');

        });

        Route::group(['prefix'  =>   'courses'], function() {

            Route::get('/', 'Admin\CourseController@index')->name('admin.courses.index');
            Route::get('/create', 'Admin\CourseController@create')->name('admin.courses.create');
            Route::post('/store', 'Admin\CourseController@store')->name('admin.courses.store');
            Route::get('/{id}/edit', 'Admin\CourseController@edit')->name('admin.courses.edit');
            Route::post('/update', 'Admin\CourseController@update')->name('admin.courses.update');
            Route::get('/{id}/delete', 'Admin\CourseController@delete')->name('admin.courses.delete');

        });

        Route::group(['prefix'  =>   'topics'], function() {

            Route::get('/{id}/view', 'Admin\CourseTopicsController@index')->name('admin.topics.index');
            Route::get('/{id}/create', 'Admin\CourseTopicsController@create')->name('admin.topics.create');
            Route::post('/store', 'Admin\CourseTopicsController@store')->name('admin.topics.store');
            Route::get('/{id}/edit', 'Admin\CourseTopicsController@edit')->name('admin.topics.edit');
            Route::post('/update', 'Admin\CourseTopicsController@update')->name('admin.topics.update');
            Route::get('/{id}/delete', 'Admin\CourseTopicsController@delete')->name('admin.topics.delete');

        });

        Route::group(['prefix'  =>   'lessons'], function() {

            Route::get('/{id}/view', 'Admin\CourseTopicsLessonController@index')->name('admin.lessons.index');
            Route::get('/{id}/create', 'Admin\CourseTopicsLessonController@create')->name('admin.lessons.create');
            Route::post('/store', 'Admin\CourseTopicsLessonController@store')->name('admin.lessons.store');
            Route::get('/{id}/edit', 'Admin\CourseTopicsLessonController@edit')->name('admin.lessons.edit');
            Route::post('/update', 'Admin\CourseTopicsLessonController@update')->name('admin.lessons.update');
            Route::get('/{id}/delete', 'Admin\CourseTopicsLessonController@delete')->name('admin.lessons.delete');

        });

    });

});


Route::get('/home', 'HomeController@index')->name('home');

