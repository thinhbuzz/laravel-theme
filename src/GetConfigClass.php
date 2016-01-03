<?php


namespace Buzz\LaravelTheme;


use Illuminate\Foundation\Application;

class GetConfigClass
{
    /**
     * @var Application
     */
    private $app;

    protected $configClass;

    /**
     * GetConfigClass constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function getClass()
    {
        $configClass = $this->app->config->get('theme.config_provider');
        if (is_null($this->configClass)) {
            $this->configClass = $this->app->make($configClass);
        }

        return $this->configClass;
    }
}