<?php

namespace Ginocampra\LaravelLeaflet\Http\Controllers;

use Illuminate\Routing\Controller;


class MapController extends Controller
{
    public function index()
    {
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
        return view('LaravelLeaflet::map', compact('initialMarkers'));
    }
}
