<?php

namespace Cirlmcesc\LaravelAliyunAssistant;

use Illuminate\Support\ServiceProvider;


class LaravelAliyunAssistantServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var boolean
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__."/../../config/aliyun.php", "aliyun");

        $this->app->singleton(LaravelAliyunAssistant::class, function () {
            include_once __DIR__."/../../aliyun-php-sdk/aliyun-php-sdk-core/Config.php";

            return new LaravelAliyunAssistant();
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__."/../../config/aliyun.php" => config_path("aliyun.php"),
        ], "config");
    }
}
