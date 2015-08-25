<?php
return [
    /*
     * Chỉ định có tự động chuyển đổi giao diện hay không (mobile, tablet, pc)
     * */
    'detect'        => true,
    /*
     * Thư mục chứa themes, được tính từ ngang hàng với thư mục app
     * */
    'view_path'     => 'resources/themes',
    /*
     * Thư mục chứa assets của theme, được tính từ ngang hàng index.php (nằm trong public)
     * */
    'assets_path'   => 'themes',
    /*
     * Theme mặc định
     * */
    'default_theme' => 'web',
    /*
     * Chỉ định theme cho tự động chuyển đổi giao diện
     * */
    'themes'        => [
        'mobile' => 'mobile_theme_name',
        'tablet' => 'tablet_theme_name',
        'pc'     => 'web_theme_name',
    ],
    /*
     * Chỉ định theme theo uri, không ảnh hưởng đến theme mặc định
     * */
    'uri'           => [
        'theme_name' => 'uri_with_regex'
    ],
    /*
     * Chỉ định theme theo prefix (sử dụng Route::group), không ảnh hưởng đến theme mặc định
     * */
    'prefix'        => [
        'theme_name' => 'prefix_with_regex'
    ]
];