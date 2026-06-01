<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\Content;

Route::get('/', Dashboard::class)->name('dashboard');

Route::get('/content', Content::class)->name('content');

Route::get('/lowongan', Content::class)->name('lowongan');

Route::get('/settings', Content::class)->name('settings');