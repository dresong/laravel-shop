<?php

namespace Dresong\LaravelShop\Wap\Member\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;

class MemberServiceProvider extends ServiceProvider
{
    private $middlewareGroups = [];
    private $routeMiddleware = array(
        "wechat.oauth" => \Overtrue\LaravelWeChat\Middleware\OAuthAuthenticate::class,
    );
    private $commands = [
        \Dresong\LaravelShop\Wap\Member\Console\Commands\InstallCommand::class,
    ];

    public function register()
    {
        $this->registerPublishing();
        $this->registerRoutes();
        $this->registerRouteMiddleware();
        $this->mergeConfigFrom(__DIR__."/../Config/member.php", "wap.member");
    }

    public function boot()
    {

        $this->loadViewsFrom(
            __DIR__.'/../Resources/Views', 'wapMember'
        );

        $this->loadMemberConfig();
        $this->loadMigrations();
        $this->commands($this->commands);
    }

    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../Http/routes.php');
        });
    }

    private function routeConfiguration()
    {
        return [
            //'domain' => config('telescope.domain', null),
            'namespace' => 'Dresong\LaravelShop\Wap\Member\Http\Controllers',
            'prefix' => 'wap/member',
            'middleware' => 'web',
        ];
    }

    protected function registerRouteMiddleware()
    {
        foreach ($this->middlewareGroups as $key => $middleware) {
            $this->app['router']->middlewareGroup($key, $middleware);
        }

        foreach ($this->routeMiddleware as $key => $middleware) {
          $this->app['router']->aliasMiddleware($key, $middleware);
        }
    }

    protected function loadMemberConfig()
    {
        config(Arr::dot(config('wap.member.auth', []), 'auth.'));
        config(Arr::dot(config('wap.member.wechat', []), 'wechat.'));
    }

    public function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../Config' => config_path('wap')],
            'laravel-shop-wap-member');
        }
    }

    public function loadMigrations()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
        }
    }
}
