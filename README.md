# Package quản lý theme cho Laravel 5.*

> Detect device use package  [serbanghita/Mobile-Detect](https://github.com/serbanghita/Mobile-Detect).
> If you want to be simple, use a version 1.
> Note: v2.* switch language to vietnamese

## Cài đặt
Mở file `composer.json` và thêm vào `require`:

```json
{
    "require": {
        "buzz/laravel-theme": "2.*"
    }
}
```

Hoặc chạy lệnh sau:

```
composer require buzz/laravel-theme
```

Chạy lệnh ```composer update``` hoặc ```composer install``` để hoàn thành cài đặt package.

### Setup

Mở file `app/config/app.php` và thêm ServiceProvider, Facade như sau.

```
'providers' => [
    //.....
    'Illuminate\Validation\ValidationServiceProvider',
    'Illuminate\View\ViewServiceProvider,
    //.....
    'Buzz\LaravelTheme\LaravelThemeServiceProvider',
],
```

```
'aliases' => [
    //.....
    'Validator' => 'Illuminate\Support\Facades\Validator,
    'View'      => 'Illuminate\Support\Facades\View,
    //.....
    'Theme' =>  'Buzz\LaravelTheme\ThemeFacade',
],
```

### Cấu hình

Tạo file cấu hình ``config/theme.php`` bằng lệnh sau:

~~~
php artisan vendor:publish --provider="Buzz\LaravelTheme\LaravelThemeServiceProvider"
~~~

hoặc

~~~
php artisan vendor:publish
~~~

### Cấu trúc
##### Assets
```
├── public/
    └── themes/
        ├── mytheme/
        |   ├── js/
        |   ├── css/
        |
        └── anothertheme/

```
##### Views
```
├── resources/
    └── themes/
        ├── mytheme/
        |   ├── views/
        |
        └── anothertheme/

```


## Sử dụng

### Gọi view

Tương tự như việc sử dụng view mặc định của laravel là dùng ``View::make`` hoặc ``view()``, xem thêm tại [views document](http://laravel.com/docs/5.1/views). Nếu khi gọi view mà view đó không tồn tại trong ``resrouces/themes`` thì sẽ được gọi đến thư mục ``resrouces/views``.

### Theme assets

Dùng ``themeAsset()`` thay cho ``asset()`` khi gọi asses cho theme, ví dụ:

```php
<link rel="stylesheet" href="{!! themeAsset('css/bootstrapt.css') !!}">
//render <link rel="stylesheet" href="http://domain/themes/theme-name/css/bootstrapt.css">
```

### Thay đổi theme

Bạn có thể thay đổi theme bằng các cách sau:

```php
app('theme')->set($themeName)
```

Hoặc

```php
setTheme($themeName);//function helper
```

Hoặc

```php
Theme::set($themeName);//use facade
```

##### Các hàm hỗ trợ

```php
Theme::client();//Trả về 1 đối tượng MobileDetect
Theme::pathTheme($name);//trả về đường dẫn của thư mục theme hiện tại hoặc theo tên theme truyền vào
Theme::currentTheme();//trả về tên của theme hiện tại
Theme::reset();//đặt lại theme mặc định
```




