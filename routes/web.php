<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Issues;
use App\Livewire\Homepage;

Route::get('/issues', Issues::class);
Route::get('/', Homepage::class);


