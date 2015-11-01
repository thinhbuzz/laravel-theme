<?php
namespace Buzz\LaravelTheme;
class RouteHelper
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * @param $app \Illuminate\Contracts\Foundation\Application
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * @return \Illuminate\Routing\Route
     */
    public function getCurrentRoute()
    {
        return $this->app->routes->match($this->app->request);
    }

}