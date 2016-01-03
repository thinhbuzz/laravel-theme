<?php
return [
    /*
     * If true, package would throw exception if theme not exist
     * */
    'exception' => false,
    /*
     * If true, package would auto add alias Theme
     * */
    'auto_alias' => true,
    'auto_alias_name' => 'Theme',
    /*
     * If true, package would auto detected device (mobile, tablet, pc)
     * */
    'detect' => false,
    /*
     * Directory containing themes, par with app directory
     * */
    'view_path' => 'resources/themes',
    /*
     * The theme folder containing assets, par index.php (located in public folder)
     * */
    'assets_path' => 'themes',
    /*
     * Name of default theme
     * */
    'default_theme' => 'web_theme_name',
    /*
     * Theme name respective for device when set detect is true
     * */
    'themes' => [
        'mobile' => 'mobile_theme_name',
        'tablet' => 'tablet_theme_name',
        'pc' => 'web_theme_name',
    ],
    /*
     * Theme follow uri (does not affect the default theme)
     * */
    'uri' => [
        'theme_name' => 'uri_with_regex'
    ],
    /*
     * Theme follow prefix (does not affect the default theme)
     * */
    'prefix' => [
        'theme_name' => 'prefix_with_regex'
    ],
    /*
     * List names excluded when use Theme::allTheme()
     * */
    'except_list'=>[
        'another_theme_name'
    ],
    /*
     * Config provider
     * */
    'config_provider' => 'LaravelSetting'
];