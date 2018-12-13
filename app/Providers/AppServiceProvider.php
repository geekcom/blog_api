<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Repositories\Contracts\UserRepositoryContract', 'App\Repositories\UserRepository');
        $this->app->bind('App\Repositories\Contracts\PostsRepositoryContract', 'App\Repositories\PostsRepository');
        $this->app->bind('App\Repositories\Contracts\CommentsRepositoryContract', 'App\Repositories\CommentsRepository');
    }
}
