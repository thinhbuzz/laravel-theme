<?php
namespace Buzz\LaravelTheme;

use Detection\MobileDetect;

class DetectTheme extends MobileDetect
{

    /**
     * DetectTheme constructor.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     */
    public function __construct($app, $currentTheme)
    {
        parent::__construct();
        if ($app->config->get('theme.detect')) {
            if ($this->getTheme() != $currentTheme && !$app->session->get('theme.force'))
                $app->session->set('theme.name', $this->getTheme());
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
            return config('theme.themes.mobile');
        elseif ($this->isTablet())
            return config('theme.themes.tablet');
        return config('theme.themes.pc');
    }
}