<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\Content;
use App\Livewire\ContentCreate;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContentController;

Route::get('/', Dashboard::class)->name('dashboard');

//content pages
Route::get('/content', Content::class)->name('content');
Route::get('/content/create', ContentCreate ::class)->name('content.create');
Route::get('/content/export', [ContentController::class, 'export'])->name('content.export');

Route::get('/content/{id}/edit', ContentCreate ::class)->name('content.edit');
Route::get('/content/{id}/preview', ContentCreate ::class)->name('content.preview');
Route::get('/content/{id}', ContentCreate ::class)->name('content.create');

Route::get('/lowongan', Content::class)->name('lowongan');

Route::get('/settings', Content::class)->name('settings');