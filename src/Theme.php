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
     * Route info.
     *
     * @var \Illuminate\Routing\Route
     */
    protected $routeInfo;

    /**
     * Package config.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * @param $app  \Illuminate\Contracts\Foundation\Application
     */
    public function __construct($app)
    {
        $this->app = $app;
        $this->config = $this->app['ThemeConfigClass'];
        $this->loadSession();
    }

    /**
     * Get all themes in folder
     *
     * @param array $except
     * @param bool|true $config
     * @return array
     */
    public function allTheme($except = [], $config = true)
    {
        $except = (array)$except;
        $themeDirs = glob(base_path($this->config->get('theme.view_path')) . '/*', GLOB_ONLYDIR);
        array_filter($themeDirs, function (&$value) {
            if ($path = basename($value)) {
                $value = $path;
            }
        });
        $excepts = ($config === true) ? array_merge($this->config->get('theme.except_list'), $except) : $except;
        return array_diff($themeDirs, $excepts);
    }

    /**
     * Check path to theme is exist or not
     *
     * @param $path
     * @return bool
     * @throws ThemeNotFoundException
     */
    protected function checkPathTheme($path)
    {
        if ($path === false) {
            if ($this->config->get('theme.exception') === true)
                throw new ThemeNotFoundException;
            else
                return false;
        }
        return $path;
    }

    /**
     * @return MobileDetect
     */
    public function client()
    {
        return $this->detect;
    }

    /**
     * Return current theme name
     *
     * @return string
     */
    public function currentTheme()
    {
        return $this->app->session->get('theme.name');
    }

    /**
     * Set session default
     *
     * @return void
     */
    private function loadDefaultSession()
    {
        $this->app->session->set('theme.name', $this->config->get('theme.default_theme'));
        $this->app->session->set('theme.force', false);
    }

    /**
     * @return void
     */
    private function loadSession()
    {
        if (!$this->app->session->has('theme'))
            $this->loadDefaultSession();
        $this->detect = new DetectTheme($this->app, $this->currentTheme());
    }

    /**
     * Return path of theme name or current theme
     *
     * @throws ThemeNotFoundException
     *
     * @return string
     */
    public function pathTheme($theme = null)
    {
        $name = is_null($theme) ? $this->currentTheme() : $theme;
        $path = realpath(base_path($this->config->get('theme.view_path') . '/' . $name));
        return $this->checkPathTheme($path);
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
     * @throws ThemeNotFoundException
     *
     * @return void
     */
    public function set($name)
    {
        $path = realpath(base_path($this->config->get('theme.view_path')) . '/' . $name);
        $this->checkPathTheme($path);
        $this->app->session->set('theme.name', $name);
        $this->app->session->set('theme.force', true);
    }
}