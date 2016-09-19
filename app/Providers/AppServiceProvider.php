<?php

namespace App\Providers;

use App\ViewComposer\CategoryComposer;
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
        //注册视图composer
        view()->composer('layout.top_nav','App\ViewComposer\UserComposer');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //注册一个想在视图中注入的服务,结果发现不注册也能用

//        $this->app->singleton('App\ViewComposer\CategoryComposer',function($app){
//            return new CategoryComposer();
//        });
    }
}
