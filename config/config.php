<?php
return [
    /*
     * detection device for client
     * */
    'detect'=>true,
    /*
     * Folder contains all theme
     * */
    'view_path'=>'resources/themes',
    /*
     * Folder contains all asset off theme
     * */
    'assets_path'=>'themes',
    /*
     * Default theme
     * */
    'default_theme'=>'web',
    /*
     * Used when detect device is enabled
     * */
    'themes'=>[
        'mobile'=>'mobile',
        'tablet'=>'tablet',
        'pc'=>'web',
    ]
];