<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    // Publik — list lowongan aktif (published)
    public function index()
    {
        $lowongans = Lowongan::with('jobCategory')
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['data' => $lowongans]);
    }

    // Publik — detail by slug 
    public function show($slug)
    {
        $lowongan = Lowongan::with('jobCategory')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return response()->json(['data' => $lowongan]);
    }
}