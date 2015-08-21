<?php
namespace Buzz\LaravelTheme;

use Detection\MobileDetect;

class Theme
{
    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;
    /**
     * The MobileDetect instance.
     *
     * @var MobileDetect
     */
    protected $detect;

    /**
     * @param $app  \Illuminate\Contracts\Foundation\Application
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->loadSession();
    }

    /**
     * @return void
     */
    private function loadSession()
    {
        if (!$this->app['session']->has('theme'))
            $this->loadDefaultSession();
        $this->detect = new DetectTheme($this->app, $this->currentTheme());
    }

    /**
     * Return current theme name
     * @return string
     */
    public function currentTheme()
    {
        return $this->app['session']->get('theme.name');
    }

    /**
     * Reset theme to default
     */
    public function reset()
    {
        $this->loadDefaultSession();
    }

    /**
     * Switch to new theme
     *
     * @param $name
     *
     * @throws ThemeNotFoundExceptions
     *
     * @return void
     */
    public function set($name)
    {
        $path = realpath(base_path(config('theme.view_path')) . '/' . $name);
        if (!$path)
            throw new ThemeNotFoundExceptions();
        $this->app['session']->set('theme.name', $name);
        $this->app['session']->set('theme.force', true);
    }

    /**
     * Return path of theme name or current theme
     *
     * @return string
     */
    public function pathTheme($theme = null)
    {
        $name = is_null($theme) ? $this->currentTheme() : $theme;
        return realpath(base_path(config('theme.view_path') . '/' . $name));
    }

    /**
     * @return MobileDetect
     */
    public function client()
    {
        return $this->detect;
    }

    /**
     * Set session default
     * @return void
     */
    private function loadDefaultSession()
    {
        $this->app['session']->set('theme.name', config('theme.default_theme'));
        $this->app['session']->set('theme.force', false);
    }
}