<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\ServiceProvider;
use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;
use URL, View;

class PostsServiceProvider extends ServiceProvider {

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
        View::composer(['laravel-authentication-acl::admin.posts.*'], function ($view) {
            $view->with('sidebar_items', [
                trans('posts.post_list') => [
                    "url" => URL::route('posts.list'),
                    "icon" => '<i class="fa fa-list"></i>'
                ],
                trans('posts.post_add') => [
                    "url" => URL::route('posts.edit'),
                    "icon" => '<i class="fa fa-plus"></i>'
                ]
            ]);
        });

    }

}
