<?php
namespace Buzz\LaravelTheme;

use Detection\MobileDetect;

class DetectTheme extends MobileDetect
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * DetectTheme constructor.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     * @param string $currentTheme
     */
    public function __construct($app, $currentTheme)
    {
        $this->app = $app;
        parent::__construct();
        if ($this->app->config->get('theme.detect')) {
            if ($this->getTheme() != $currentTheme && !$this->app->session->get('theme.force'))
                $this->app->session->set('theme.name', $this->getTheme());
        }
    }

    /**
     * Return the theme name matching the device
     *
     * @return string
     */
    public function getTheme()
    {
        if ($this->isMobile())
            return $this->app->config->get('theme.themes.mobile');
        elseif ($this->isTablet())
            return $this->app->config->get('theme.themes.tablet');
        return $this->app->config->get('theme.themes.pc');
    }
}