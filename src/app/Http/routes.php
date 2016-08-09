<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */

Route::get('/', function () {
    return view('welcome');
});


/**
 * User login and logout
 */
Route::group(['middleware' => ['web']], function () {
    Route::group(['middleware' => ['admin_logged', 'can_see']], function () {

        /**
         * tasks
         */
        Route::get('/admin/tasks/list', [
                'as'   => 'tasks.list',
                'uses' => 'TasksController@getList'
        ]);
        Route::get('/admin/tasks/edit', [
                'as'   => 'tasks.edit',
                'uses' => 'TasksController@editTask'
        ]);
        Route::post('/admin/tasks/edit', [
                'as'   => 'tasks.edit',
                'uses' => 'TasksController@postEditTask'
        ]);
        Route::get('/admin/tasks/delete', [
                'as'   => 'tasks.delete',
                'uses' => 'TasksController@deleteTask'
        ]);

        
        /**
         * statuses
         */
        Route::get('/admin/statuses/list', [
                'as'   => 'statuses.list',
                'uses' => 'StatusesController@getList'
        ]);
        Route::get('/admin/statuses/edit', [
                'as'   => 'statuses.edit',
                'uses' => 'StatusesController@editStatus'
        ]);
        Route::post('/admin/statuses/edit', [
                'as'   => 'statuses.edit',
                'uses' => 'StatusesController@postEditStatus'
        ]);
        Route::get('/admin/statuses/delete', [
                'as'   => 'statuses.delete',
                'uses' => 'StatusesController@deleteStatus'
        ]);
        
        /**
         * Catagories
         */
        Route::get('/admin/categories/list', [
                'as'   => 'categories.list',
                'uses' => 'CategoriesController@getList'
        ]);
        Route::get('/admin/categories/edit', [
                'as'   => 'categories.edit',
                'uses' => 'CategoriesController@editCategory'
        ]);
        Route::post('/admin/categories/edit', [
                'as'   => 'categories.edit',
                'uses' => 'CategoriesController@postEditCategory'
        ]);
        Route::get('/admin/categories/delete', [
                'as'   => 'categories.delete',
                'uses' => 'CategoriesController@deleteCategory'
        ]);
        
    });
});
