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
         * User search by ajax
         */
        Route::post('/ajax/user_search', [
            'as' => 'ajax_user.search',
            'uses' => 'UsersController@ajax_search_user'
        ]);
        Route::get('/ajax/user_search', [
            'as' => 'ajax_user.search',
            'uses' => 'UsersController@ajax_search_user'
        ]);

        /**
         * tasks
         */
        Route::get('/admin/tasks/list', [
            'as' => 'tasks.list',
            'uses' => 'TasksController@getList'
        ]);
        Route::get('/admin/tasks/edit', [
            'as' => 'tasks.edit',
            'uses' => 'TasksController@editTask'
        ]);
        Route::post('/admin/tasks/edit', [
            'as' => 'tasks.edit',
            'uses' => 'TasksController@postEditTask'
        ]);
        Route::get('/admin/tasks/delete', [
            'as' => 'tasks.delete',
            'uses' => 'TasksController@deleteTask'
        ]);


        /**
         * statuses
         */
        Route::get('/admin/statuses/list', [
            'as' => 'statuses.list',
            'uses' => 'StatusesController@getList'
        ]);
        Route::get('/admin/statuses/edit', [
            'as' => 'statuses.edit',
            'uses' => 'StatusesController@editStatus'
        ]);
        Route::post('/admin/statuses/edit', [
            'as' => 'statuses.edit',
            'uses' => 'StatusesController@postEditStatus'
        ]);
        Route::get('/admin/statuses/delete', [
            'as' => 'statuses.delete',
            'uses' => 'StatusesController@deleteStatus'
        ]);

        /**
         * Catagories
         */
        Route::get('/admin/categories/list', [
            'as' => 'categories.list',
            'uses' => 'CategoriesController@getList'
        ]);
        Route::get('/admin/categories/edit', [
            'as' => 'categories.edit',
            'uses' => 'CategoriesController@editCategory'
        ]);
        Route::post('/admin/categories/edit', [
            'as' => 'categories.edit',
            'uses' => 'CategoriesController@postEditCategory'
        ]);
        Route::get('/admin/categories/delete', [
            'as' => 'categories.delete',
            'uses' => 'CategoriesController@deleteCategory'
        ]);

        /**
         * Levels
         */
        Route::get('/admin/levels/list', [
            'as' => 'levels.list',
            'uses' => 'LevelsController@getList'
        ]);
        Route::get('/admin/levels/edit', [
            'as' => 'levels.edit',
            'uses' => 'LevelsController@editLevel'
        ]);
        Route::post('/admin/levels/edit', [
            'as' => 'levels.edit',
            'uses' => 'LevelsController@postEditLevel'
        ]);
        Route::get('/admin/levels/delete', [
            'as' => 'levels.delete',
            'uses' => 'LevelsController@deleteLevel'
        ]);


        /**
         * Faqs
         */
        Route::get('/admin/faqs/list', [
            'as' => 'faqs.list',
            'uses' => 'FaqsController@getList'
        ]);
        Route::get('/admin/faqs/edit', [
            'as' => 'faqs.edit',
            'uses' => 'FaqsController@editFaq'
        ]);
        Route::post('/admin/faqs/edit', [
            'as' => 'faqs.edit',
            'uses' => 'FaqsController@postEditFaq'
        ]);
        Route::get('/admin/faqs/delete', [
            'as' => 'faqs.delete',
            'uses' => 'FaqsController@deleteFaq'
        ]);

        /**
         * Posts
         */
        Route::get('/admin/posts/list', [
            'as' => 'posts.list',
            'uses' => 'PostsController@getList'
        ]);
        Route::get('/admin/posts/edit', [
            'as' => 'posts.edit',
            'uses' => 'PostsController@editPost'
        ]);
        Route::post('/admin/posts/edit', [
            'as' => 'posts.edit',
            'uses' => 'PostsController@postEditPost'
        ]);
        Route::get('/admin/posts/delete', [
            'as' => 'posts.delete',
            'uses' => 'PostsController@deletePost'
        ]);
    });
});


Route::group(['middleware' => ['web']], function () {
    Route::group(['middleware' => ['admin_logged', 'can_see']], function () {
        /**
         * Users Tasks
         */
        Route::get('/user/tasks/list', [
            'as' => 'user_tasks.list',
            'uses' => 'User\UserTasksController@getList'
        ]);
        Route::get('/user/tasks/edit', [
            'as' => 'user_tasks.edit',
            'uses' => 'User\UserTasksController@editUserTask'
        ]);
        Route::post('/user/tasks/edit', [
            'as' => 'user_tasks.edit',
            'uses' => 'User\UserTasksController@postEditUserTask'
        ]);
        Route::get('/user/tasks/delete', [
            'as' => 'user_tasks.delete',
            'uses' => 'User\UserTasksController@deleteUserTask'
        ]);
    });
});
