<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Http\Resources\PostsResource::withoutWrapping();
        \App\Http\Resources\LikeResource::withoutWrapping();
        \App\Http\Resources\CategoriesResource::withoutWrapping();
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);
    }
}
