## Laravel Leaflet Package

[![Laravel 7|8|9|10](https://img.shields.io/badge/Laravel-8|9|10-orange.svg)](http://laravel.com)
[![Latest Stable Version](https://img.shields.io/packagist/v/ginocampra/laravel-leaflet)](https://packagist.org/packages/ginocampra/laravel-leaflet)
[![Total Downloads](https://poser.pugx.org/ginocampra/laravel-leaflet/downloads.png)](https://packagist.org/packages/ginocampra/laravel-leaflet)
[![License](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/ginocampra/laravel-leaflet)

Allows you to create pages with Leaflet maps in an integrated way with Laravel.

How to Install:

Install a basic Laravel Project.

```bash
composer create-project laravel/laravel:^8.0 example-app
 
cd example-app
```

Run this command to install the package and configure the Laravel Project

```bash
composer require ginocampra/laravel-leaflet
```

Run the server

```bash
php artisan serve
```

Open you browser "http://127.0.0.1:8000/map"

You will see:

<img src="https://github.com/ginocampra/laravel-leaflet/blob/master/images/itworks.png" alt="LaravelLeaflet" height="350">

## Blade Component

You can use this to inject a Leaflet Map in you Blade views

Implement $title and $markers in your Controller and pass to view

```php

    $options = [
        'center' => [
            'lat' => -23.347509137997484,
            'lng' => -47.84753617004771
        ],
        'googleview' => true,
        'zoom' => 18,
        'zoomControl' => true,
        'minZoom' => 13,
        'maxZoom' => 18,
    ];
    $initialMarkers = [
        [
            'position' => [
                'lat' => -23.347509137997484,
                'lng' => -47.84753617004771
            ],
            'draggable' => false,
            'title' => 'Tatuí - SP'
        ]
    ];
    $initialPolygons = [
        [
            [-23.34606370264136 , -47.84818410873414],
            [-23.34575341324051 , -47.84759938716888],
            [-23.34615728184211 , -47.84729361534119],
            [-23.34651189716213 , -47.84792125225068]
        ]
    ];
    $initialPolylines = [
            [
                [-23.348914298657980 , -47.850147485733040],
                [-23.347850469110245 , -47.848109006881714],
                [-23.349209805352476 , -47.847293615341194],
                [-23.347781516900888 , -47.844675779342660]               
            ]
    ];
    $initialRectangles = [
        [
            [-23.347683013682527 , -47.85067319869996],
            [-23.346727528670904 , -47.84879565238953]
        ]
    ];
    $initialCircles = [
        [
            'position' => [ 
                'lat' => -23.346569922234977, 
                'lng' => -47.84376382827759
            ],
            'radius' => 80.68230575309364
        ]
    ];
    $title = 'Initial Map';
    
    return view('welcome',compact('options','title','initialMarkers','initialPolygons','initialPolylines','initialRectangles','initialCircles'));

```

Drop the blade component in the view

```php

        <div>
            <x-laravel-map :title="$title" :initialMarkers="$initialMarkers" :initialPolygons="$initialPolygons" :initialPolylines="$initialPolylines" :initialRectangles="$initialRectangles" :initialCircles="$initialCircles" :options="$options"/>
        </div>

```

## License

The MIT License (MIT). Please see [License File](https://github.com/ginocampra/laravel-leaflet/blob/master/LICENSE.md) for more information.
