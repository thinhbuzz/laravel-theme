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
        $defaultView  = $this->app['config']['view.paths'];
        $route        = new RouteHelper($this->app);
        $currentRoute = $route->getCurrentRoute();
        if ($uri = theme_name_match(config('theme.uri', []), $currentRoute->getUri()))
            $curentView = $this->loadPathWithUri($uri);
        elseif ($prefix = theme_name_match(config('theme.prefix', []), $currentRoute->getPrefix()))
            $curentView = $this->loadPathWithPrefix($prefix);
        else
            $curentView = $this->app['theme']->pathTheme();
        $viewPaths                         = array_merge([$curentView], $defaultView);
        $this->app['config']['view.paths'] = $viewPaths;
    }

    protected function bootConfig()
    {
        $path = __DIR__ . '/../config/config.php';
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

    private function loadPathWithUri($uri)
    {
        return $this->app['theme']->pathTheme($uri);
    }

    private function loadPathWithPrefix($prefix)
    {
        return $this->app['theme']->pathTheme($prefix);
    }
}