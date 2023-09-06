<?php

namespace Ginocampra\LaravelLeaflet\View\Components;

use Illuminate\View\Component;

class LaravelMap extends Component
{

    public $title;
    public $markers = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = null,$markers = null)
    {
        $this->title = $title;
        $this->markers = $markers;
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
            'initialMarkers' => $this->markers
        ]);
    }
}
