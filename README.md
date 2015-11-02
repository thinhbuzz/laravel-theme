# Theme Management for Laravel 5.*

> Detect device use package  [serbanghita/Mobile-Detect](https://github.com/serbanghita/Mobile-Detect).
> If you want to be simple, use a version 1.
> Note: v2.* switch language to vietnamese

## Contents

1. <a href="#introduction">Introduction</a>
2. <a href="#installation">Installation</a>
3. <a href="#configuration">Configuration</a>
4. <a href="#structure">Structure</a>
5. <a href="#usage">Usage</a>

## Introduction
This is package support the management view files and assets under separate folders. Compatible with Laravel 5.*

## Installation
The first run command:

```
composer require buzz/laravel-theme 2.*
```

and then open `config/app.php` add `LaravelThemeServiceProvider` to array `providers`

```
'providers' => [
    //.....
    'Illuminate\Validation\ValidationServiceProvider',
    'Illuminate\View\ViewServiceProvider,
    //.....
    'Buzz\LaravelTheme\LaravelThemeServiceProvider',
],
```

Add `Theme` alias (when set `auto_alias => false` in theme config):

```
'aliases' => [
    //.....
    'Validator' => 'Illuminate\Support\Facades\Validator',
    'View'      => 'Illuminate\Support\Facades\View',
    //.....
    'Theme' =>  'Buzz\LaravelTheme\ThemeFacade',
],
```

## Configuration

Publish config file `config/theme.php` with command:

~~~
php artisan vendor:publish --provider="Buzz\LaravelTheme\LaravelThemeServiceProvider"
~~~

## Usage

### Structure
##### Assets

```
├── public/
    └── themes/
        ├── theme_name/
        |   ├── js/
        |   ├── css/
        |
        └── another_theme_name/

```

##### Views

```
├── resources/
    └── themes/
        ├── theme_name/
        |   ├── index.blade.php
        |   ├── footer.blade.php
        |
        └── another_theme_name/

```

### Render view

package does not change the way you render view, you still use the `View::make` or `view()` as default of laravel, read more on [views document](http://laravel.com/docs/5.1/views). If the render view and the view does not exist in the `resources/themes/theme-name`, it will render view in `resources/views`.

### Theme assets

Use ``themeAsset()`` instead of ``asset()`` when link to assets in theme, example:

```php
<link rel="stylesheet" href="{!! themeAsset('css/bootstrap.css') !!}">
//render <link rel="stylesheet" href="http://domain/themes/theme-name/css/bootstrap.css">
```

### Change current theme

You can change the theme in the following ways:

```php
app('theme')->set($themeName)
```

Or use function helper

```php
setTheme($themeName);//function helper
```

or use Facade

```php
Theme::set($themeName);//use facade
```

### Support methods

```php
Theme::client();//return object of MobileDetect
Theme::pathTheme($name = null);//return path to current theme or name input
Theme::currentTheme();//return name of current theme
Theme::reset();//reset default theme
Theme::set();//set theme
Theme::allTheme($except = [], $config = true);//get list theme in folder themes
themeAsset($name = false);//link to asset current theme or by theme name
setTheme($name);// change theme by theme name
```

> P/s: excuse me my English.