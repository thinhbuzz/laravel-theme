<?php
if (!function_exists('themeAsset')) {
    function themeAsset($path, $themeName = false)
    {
        if ($themeName === false)
            $themeName = app('theme')->currentTheme();
        $path = themeConfig('theme.assets_path') . '/' . $themeName . '/' . ltrim($path, '/');
        return asset($path);
    }
}
if (!function_exists('setTheme')) {
    function setTheme($name)
    {
        app('theme')->set($name);
    }
}
if (!function_exists('themeConfig')) {
    function themeConfig($key = null, $default = null)
    {
        if (is_null($key)) {
            return app('ThemeConfigClass');
        }

        if (is_array($key)) {
            return app('ThemeConfigClass')->set($key);
        }

        return app('ThemeConfigClass')->get($key, $default);
    }
}
if (!function_exists('theme_name_match')) {
    function theme_name_match(array $array, $search)
    {
        foreach ($array as $key => $val) {
            if (preg_match('#' . str_replace('#', '\\#', trim($val, '/')) . '#i', $search))
                return $key;
        }
        return false;
    }
}