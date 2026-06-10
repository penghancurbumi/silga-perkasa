<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\Content;
use App\Livewire\ContentCreate;
use App\Livewire\ContentEdit;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ContentController;

Route::get('/', Dashboard::class)->name('dashboard');

//content pages
Route::get('/content', Content::class)->name('content');
Route::get('/content/create', ContentCreate::class)->name('content.create');
Route::get('/content/export', [ContentController::class, 'export'])->name('content.export');
Route::delete('/content/delete', [ContentController::class, 'destroy'])->name('content.destroy');

Route::get('/content/{id}/edit', ContentEdit ::class)->name('content.edit');
Route::get('/content/{id}/preview', Content ::class)->name('content.preview');
Route::get('/content/{id}', Content ::class)->name('content.create');

Route::get('/lowongan', Content::class)->name('lowongan');

Route::get('/settings', Content::class)->name('settings');