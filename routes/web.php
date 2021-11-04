<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/fig04', function () {
    $data4 = [
        ['label' => 'Athlete', 'color' => '#217ca3', 'values' => [16, 271, 268, 258, 211]],
        ['label' => 'NonAthlete', 'color' => '#8d230f', 'values' => [748, 640, 883, 1394, 374]]
    ];

    $series4 = [
        'title' => 'Number of Applications - TRAD Programs',
        'categories' => ['Fall 2017', 'Fall 2018', 'Fall 2019', 'Fall 2020', 'Fall 2021'],
        'data' => $data4,
    ];

    return $series4;
});
