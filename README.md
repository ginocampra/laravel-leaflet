# Laravel Leaflet Package

[![Laravel 7|8|9|10](https://img.shields.io/badge/Laravel-8|9|10-orange.svg)](http://laravel.com)
[![Latest Stable Version](https://img.shields.io/packagist/v/ginocampra/laravel-leaflet)](https://packagist.org/packages/ginocampra/laravel-leaflet)
[![Total Downloads](https://poser.pugx.org/ginocampra/laravel-leaflet/downloads.png)](https://packagist.org/packages/ginocampra/laravel-leaflet)
[![License](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/ginocampra/laravel-leaflet)

Allows you to create screens with Leaflet maps in an integrated way with Laravel.

How to Install:

Install a basic Laravel Project.

```bash
composer create-project laravel/laravel:^8.0 example-app
 
cd example-app

composer install
```

Run this commands to install the package and configure the Laravel Project

```bash
composer require ginocampra/laravel-leaflet

composer dump-autoload

php artisan optimize

php artisan serve
```

Open you browser "http://127.0.0.1:8000/map"

You will see:

<img src="https://github.com/ginocampra/laravel-leaflet/images/itworks.png" alt="LaravelLeaflet" height="64">

## License

The MIT License (MIT). Please see [License File](https://github.com/ginocampra/laravel-leaflet/LICENSE.md) for more information.
