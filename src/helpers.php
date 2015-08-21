<?php
if (!function_exists('themeAsset')) {
    function themeAsset($path)
    {
        $themeName = app('theme')->currentTheme();
        $path      = config('theme.assets_path') . '/' . $themeName . '/' . ltrim($path, '/');
        return asset($path);
    }
}
if (!function_exists('setTheme')) {
    function setTheme($name)
    {
        app('theme')->set($name);
    }
}