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
        if (config('themes.detect')) {
            if ($this->getTheme() != $currentTheme && !$app['session']->get('themes.force'))
                $app['session']->set('themes.name', $this->getTheme());
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
            return config('themes.themes.mobile');
        elseif ($this->isTablet())
            return config('themes.themes.tablet');
        return config('themes.themes.pc');
    }
}