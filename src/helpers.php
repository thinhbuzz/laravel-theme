<?php
if (!function_exists('themeAsset')) {
    function themeAsset($path, $themeName = false)
    {
        if ($themeName === false)
            $themeName = app('theme')->currentTheme();
        $path = config('theme.assets_path') . '/' . $themeName . '/' . ltrim($path, '/');
        return asset($path);
    }
}
if (!function_exists('setTheme')) {
    function setTheme($name)
    {
        app('theme')->set($name);
    }
}
if (!function_exists('theme_name_match')) {
    function theme_name_match(array $array, $search)
    {
        foreach ($array as $key => $val) {
            if (preg_match('#' . str_replace('#', '\\#', $val) . '#i', $search))
                return $key;
        }
        return false;
    }
}