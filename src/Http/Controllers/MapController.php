<?php

namespace Ginocampra\LaravelLeaflet\Http\Controllers;

use Illuminate\Routing\Controller;


class MapController extends Controller
{
    public function index()
    {
        $options = [
            'center' => [
                'lat' => -23.347509137997484,
                'lng' => -47.84753617004771
            ]
        ];
        $initialMarkers = [
            [
                'position' => [
                    'lat' => -23.347509137997484,
                    'lng' => -47.84753617004771
                ],
                'draggable' => true,
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
        $title = 'Initial Map';

        return view('LaravelLeaflet::map', compact('options','title','initialMarkers','initialPolygons'));
    }

}
