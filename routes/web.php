<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Issues;

Route::get('/issues', Issues::class);


Route::get('/', function () {
    return view('welcome');
});

