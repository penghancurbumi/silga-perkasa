<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\Content;
use App\Http\Controllers\PostController;

Route::get('/', Dashboard::class)->name('dashboard');

Route::get('/content', ([PostController::class, 'index']))->name('content');
Route::get('/content/create', ([PostController::class, 'create']))
    ->name('content.create');

Route::get('/lowongan', Content::class)->name('lowongan');

Route::get('/settings', Content::class)->name('settings');