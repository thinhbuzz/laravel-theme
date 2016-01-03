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
        $app = $this->app;
        $defaultView = $app->config->get('view.paths', []);
        $route = new RouteHelper($app);
        $currentRoute = $route->getCurrentRoute();
        if ($uri = theme_name_match($app['ThemeConfigClass']->get('theme.uri', []), $currentRoute->getUri())) {
            $curentView = $this->loadPathWithUri($uri);
        } elseif ($prefix = theme_name_match($app['ThemeConfigClass']->get('theme.prefix', []), $currentRoute->getPrefix())) {
            $curentView = $this->loadPathWithPrefix($prefix);
        } else {
            $curentView = $app->theme->pathTheme();
        }
        if ($curentView) {
            $viewPaths = array_merge([$curentView], $defaultView);
            $finder = new \Illuminate\View\FileViewFinder($app['files'], $viewPaths);
            $app['view']->setFinder($finder);
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
        $this->app->singleton('ThemeConfigClass', function ($app) {
            return (new GetConfigClass($app))->getClass();
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
        if ($this->app['ThemeConfigClass']->get('theme.auto_alias', false)) {
            \Illuminate\Foundation\AliasLoader::getInstance()
                ->alias(
                    $this->app['ThemeConfigClass']->get('theme.auto_alias_name', 'Theme'),
                    ThemeFacade::class
                );
        }
    }
}