<?php

namespace Ginocampra\LaravelLeaflet\View\Components;

use Illuminate\View\Component;

class LaravelMap extends Component
{

    public $options = [];
    public $title;
    public $initialMarkers = [];
    public $initialPolygons = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($options = null, $title = null, $initialMarkers = null, $initialPolygons = null)
    {
        $this->options = $options;
        $this->title = $title;
        $this->initialMarkers = $initialMarkers;
        $this->initialPolygons = $initialPolygons;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('LaravelLeaflet::components.laravel-map',[
            'title' => $this->title,
            'initialMarkers' => $this->initialPolygons,
            'initialPolygons' => $this->initialPolygons,
            'options' => $this->options

        ]);
    }
}
