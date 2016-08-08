<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\ServiceProvider;
use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;
use URL, View;

class TasksServiceProvider extends ServiceProvider {

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
        View::composer(['laravel-authentication-acl::admin.tasks.*'], function ($view) {
            $view->with('sidebar_items', [
                "List" => [
                    "url" => URL::route('tasks.list'),
                    "icon" => '<i class="fa fa-list"></i>'
                ],
                "Add testimonial" => [
                    "url" => URL::route('tasks.edit'),
                    "icon" => '<i class="fa fa-plus"></i>'
                ]
            ]);
        });

    }

}
