<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\ServiceProvider;
use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;
use URL, View;

class UsersTasksServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot() {

        //Testimonials
        View::composer(['laravel-authentication-acl::admin.users_tasks.*'], function ($view) {
            $view->with('sidebar_items', [
                trans('tasks.task_list') => [
                    "url" => URL::route('tasks.list'),
                    "icon" => '<i class="fa fa-list"></i>'
                ],
            ]);
        });

    }

}
