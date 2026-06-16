<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Livewire\Dashboard;
use App\Livewire\Content;
use App\Livewire\Setting;
use App\Livewire\ContentCreate;
use App\Livewire\ContentEdit;
use App\Livewire\AuthLogin;
use App\Livewire\AuthRegister;
use App\Models\ActivityLog;
use App\Livewire\Activity;
use App\Livewire\Profile;
use App\Livewire\Lamaran;

use App\Http\Controllers\PostController;
use App\Http\Controllers\ContentController;


Route::get('/login', AuthLogin::class)->name('login');
Route::post('/logout', function () {
    ActivityLog::create([
        'user_id'=>Auth::id(),
        'type'=>'logout',
        'description'=>'User logged out',
        'ip_address'=>request()->ip(),
    ]);
    Auth::logout();
    session()->regenerate();
    return redirect()->route('login');
})->name('logout');

Route::get('/register', AuthRegister::class)->name('Register');


Route::middleware('auth')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');

//content pages
Route::get('/content', Content::class)->name('content');
Route::get('/content/create', ContentCreate::class)->name('content.create');
Route::get('/content/export', [ContentController::class, 'export'])->name('content.export');
Route::delete('/content/delete', [ContentController::class, 'destroy'])->name('content.destroy');

Route::get('/content/{id}/edit', ContentEdit ::class)->name('content.edit');
Route::get('/content/{id}/preview', Content ::class)->name('content.preview');
Route::get('/content/{id}', Content ::class)->name('content.create');

Route::get('/activity', Activity::class)->name('activity');
Route::get('/lamaran', Lamaran::class)->name('lamaran');
Route::get('/lowongan', Content::class)->name('lowongan');
Route::get('/settings', Setting::class)->name('settings');
Route::get('/profile', Profile::class)->name('profile');
});
