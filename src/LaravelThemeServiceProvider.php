<?php
namespace Buzz\LaravelTheme;

use Illuminate\Support\ServiceProvider;

class LaravelThemeServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootConfig();
        $this->setViewPath();
    }

    protected function setViewPath()
    {
        $defaultView                       = $this->app['config']['view.paths'];
        $curentView                        = $this->app['theme']->pathTheme();
        $viewPaths                         = array_merge([$curentView], $defaultView);
        $this->app['config']['view.paths'] = $viewPaths;
    }

    protected function bootConfig()
    {
        $path = __DIR__ . '/config.php';
        $this->mergeConfigFrom($path, 'theme');
        $this->publishes([$path => config_path('theme.php')]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'theme', function ($app){
            return new Theme(
                $app
            );
        }
        );
    }
}