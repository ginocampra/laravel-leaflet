<?php

use Illuminate\Support\Facades\Route;
use Ginocampra\LaravelLeaflet\Http\Controllers\MapController;

Route::get('/map', [MapController::class, 'index']);
