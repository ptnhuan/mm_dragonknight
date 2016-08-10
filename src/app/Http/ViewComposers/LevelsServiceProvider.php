<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\ServiceProvider;
use LaravelAcl\Authentication\Classes\Menu\SentryMenuFactory;
use URL, View;

class LevelsServiceProvider extends ServiceProvider {

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
     */
    public function boot() {

        //Testimonials
        View::composer(['laravel-authentication-acl::admin.levels.*'], function ($view) {
            $view->with('sidebar_items', [
                trans('levels.level_list') => [
                    "url" => URL::route('levels.list'),
                    "icon" => '<i class="fa fa-list"></i>'
                ],
                trans('levels.level_add') => [
                    "url" => URL::route('levels.edit'),
                    "icon" => '<i class="fa fa-plus"></i>'
                ]
            ]);
        });
    }
}