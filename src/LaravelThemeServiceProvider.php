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
        $this->registerAlias();
    }

    protected function setViewPath()
    {
        $defaultView = $this->app->config->get('view.paths',[]);
        $route = new RouteHelper($this->app);
        $currentRoute = $route->getCurrentRoute();
        if ($uri = theme_name_match($this->app->config->get('theme.uri', []), $currentRoute->getUri()))
            $curentView = $this->loadPathWithUri($uri);
        elseif ($prefix = theme_name_match($this->app->config->get('theme.prefix', []), $currentRoute->getPrefix()))
            $curentView = $this->loadPathWithPrefix($prefix);
        else
            $curentView = $this->app->theme->pathTheme();
        if ($curentView) {
            $viewPaths = array_merge([$curentView], $defaultView);
            $this->app->config->set('view.paths', $viewPaths);
        }
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
        $this->app->singleton('theme', function ($app) {
            return new Theme($app);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['theme'];
    }

    private function loadPathWithUri($uri)
    {
        return $this->app->theme->pathTheme($uri);
    }

    private function loadPathWithPrefix($prefix)
    {
        return $this->app->theme->pathTheme($prefix);
    }

    private function registerAlias()
    {
        if ($this->app->config->get('theme.auto_alias', false)) {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Theme', ThemeFacade::class);
        }
    }
}