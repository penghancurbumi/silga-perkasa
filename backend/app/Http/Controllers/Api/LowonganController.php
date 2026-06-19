<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LowonganController extends Controller
{
    // Publik — list lowongan aktif
    public function index()
    {
        $lowongans = Lowongan::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['data' => $lowongans]);
    }

    // Publik — detail by slug 
    public function show(string $slug)
    {
        $lowongan = Lowongan::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return response()->json(['data' => $lowongan]);
    }

    // HRD — list semua lowongan
    public function list(Request $request)
    {
        $query = Lowongan::latest();

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('is_active')) {
            $query->where('is_active', $request->is_active);
        }

        return response()->json([
            'data' => $query->paginate($request->per_page ?? 10),
        ]);
    }

    // HRD — tambah lowongan
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'department'   => 'required|string|max:255',
            'location'     => 'required|string|max:255',
            'type'         => 'required|in:fulltime,parttime,internship,contract,freelance',
            'description'  => 'required|string',
            'requirements' => 'required|string',
            'deadline'     => 'required|date|after:today',
            'is_active'    => 'boolean',
        ]);

        $lowongan = Lowongan::create([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title) . '-' . time(),
            'department'   => $request->department,
            'location'     => $request->location,
            'type'         => $request->type,
            'description'  => $request->description,
            'requirements' => $request->requirements,
            'deadline'     => $request->deadline,
            'is_active'    => $request->is_active ?? true,
        ]);

        return response()->json([
            'message' => 'Lowongan berhasil ditambahkan.',
            'data'    => $lowongan,
        ], 201);
    }

    // HRD — edit lowongan
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'department'   => 'required|string|max:255',
            'location'     => 'required|string|max:255',
            'type'         => 'required|in:fulltime,parttime,internship,contract,freelance',
            'description'  => 'required|string',
            'requirements' => 'required|string',
            'deadline'     => 'required|date',
            'is_active'    => 'boolean',
        ]);

        $lowongan = Lowongan::findOrFail($id);
        $lowongan->update([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title) . '-' . time(),
            'department'   => $request->department,
            'location'     => $request->location,
            'type'         => $request->type,
            'description'  => $request->description,
            'requirements' => $request->requirements,
            'deadline'     => $request->deadline,
            'is_active'    => $request->is_active,
        ]);

        return response()->json([
            'message' => 'Lowongan berhasil diperbarui.',
            'data'    => $lowongan,
        ]);
    }

    // HRD — toggle aktif/nonaktif
    public function toggle($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        $lowongan->update(['is_active' => !$lowongan->is_active]);

        return response()->json([
            'message' => 'Status lowongan berhasil diubah.',
            'data'    => $lowongan,
        ]);
    }

    // HRD — hapus lowongan
    public function destroy($id)
    {
        Lowongan::findOrFail($id)->delete();

        return response()->json(['message' => 'Lowongan berhasil dihapus.']);
    }
}