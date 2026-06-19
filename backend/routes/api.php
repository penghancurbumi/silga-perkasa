<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\LowonganController;
use App\Http\Controllers\Api\ApplicationController;
use App\Http\Controllers\Api\ApplicantController;

Route::apiResource('posts', PostController::class);

// Publik
Route::get('lowongan', [LowonganController::class, 'index']);
Route::get('lowongan/{slug}', [LowonganController::class, 'show']);

// HRD / Admin
Route::prefix('admin')->group(function () {
    // Lowongan
    Route::get('lowongan', [LowonganController::class, 'list']);
    Route::post('lowongan', [LowonganController::class, 'store']);
    Route::put('lowongan/{id}', [LowonganController::class, 'update']);
    Route::patch('lowongan/{id}/toggle', [LowonganController::class, 'toggle']);
    Route::delete('lowongan/{id}', [LowonganController::class, 'destroy']);

    // Application (Lamaran)
    Route::get('applications', [ApplicationController::class, 'index']);
    Route::get('applications/{id}', [ApplicationController::class, 'show']);
    Route::patch('applications/{id}/status', [ApplicationController::class, 'updateStatus']);
    Route::delete('applications/{id}', [ApplicationController::class, 'destroy']);
});
