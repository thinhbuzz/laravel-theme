<?php
return [
    /*
     * Nếu là true, sẽ throw new ThemeNotFoundException nếu theme không tồn tại.
     * */
    'exception' => false,
    /*
     * Chỉ định có phải là lần chạy đầu tiên sau khi cài đặt package
     * */
    'auto_alias' => true,
    /*
     * Chỉ định có tự động chuyển đổi giao diện hay không (mobile, tablet, pc)
     * */
    'detect' => false,
    /*
     * Thư mục chứa themes, được tính từ ngang hàng với thư mục app
     * */
    'view_path' => 'resources/themes',
    /*
     * Thư mục chứa assets của theme, được tính từ ngang hàng index.php (nằm trong public)
     * */
    'assets_path' => 'themes',
    /*
     * Theme mặc định
     * */
    'default_theme' => 'web_theme_name',
    /*
     * Chỉ định theme cho tự động chuyển đổi giao diện
     * */
    'themes' => [
        'mobile' => 'mobile_theme_name',
        'tablet' => 'tablet_theme_name',
        'pc' => 'web_theme_name',
    ],
    /*
     * Chỉ định theme theo uri, không ảnh hưởng đến theme mặc định
     * */
    'uri' => [
        'theme_name' => 'uri_with_regex'
    ],
    /*
     * Chỉ định theme theo prefix (sử dụng Route::group), không ảnh hưởng đến theme mặc định
     * */
    'prefix' => [
        'theme_name' => 'prefix_with_regex'
    ],
    /*
     * Danh sách theme bị loại trừ khi lấy tất cả themes (Theme::allTheme())
     * */
    'except_list'=>[
        'another_theme_name'
    ]
];