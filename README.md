# Themes management package for Laravel 5.* 


> Detect device use package  [serbanghita/Mobile-Detect](https://github.com/serbanghita/Mobile-Detect).

## Installation

Add the following line to the `require` section of `composer.json`:

```json
{
    "require": {
        "buzz/laravel-theme": "1.*"
    }
}
```

OR

Require this package with composer:
```
composer require buzz/laravel-theme
```

Update your packages with ```composer update``` or install with ```composer install```.

## Laravel 5

### Setup

Add ServiceProvider, Facade to the file `app/config/app.php`.

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

### Configuration

Publish config using artisan CLI.

~~~
php artisan vendor:publish --provider="Teepluss\Theme\ThemeServiceProvider"
~~~

Or

~~~
php artisan vendor:publish
~~~

### Usage
### Structure
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
##### Call views

Using similar on [views document](http://laravel.com/docs/5.1/views). When you return view if view file not exist in theme folder, view file will be load in resrouces/views.

##### Theme assets

Use themeAsset() replace for asset() when call to asset of theme

```php
<link rel="stylesheet" href="{!! themeAsset('css/bootstrapt.css') !!}">
//render <link rel="stylesheet" href="http://domain/themes/theme-name/css/bootstrapt.css">
```

##### Change theme

OR

```php
app('theme')->set($themeName)
```

OR

```php
setTheme($themeName);//function helper
```

OR

```php
Theme::set($themeName);//use facade
```

##### Helper

```php
Theme::client();//return MobileDetect object
Theme::pathTheme($name);//return path of theme or current theme
Theme::currentTheme();//return name of current theme
Theme::reset();//reset theme to default config
```

## Contribute

https://github.com/thinhbuzz/laravel-theme/pulls