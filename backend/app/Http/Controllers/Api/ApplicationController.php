<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    // list semua lamaran
    public function index(Request $request)
    {
        $query = Application::with(['applicant', 'lowongan'])
            ->latest('applied_at');

        if ($request->search) {
            $query->whereHas('applicant', function ($q) use ($request) {
                $q->where('fullname', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->lowongan_id) {
            $query->where('lowongan_id', $request->lowongan_id);
        }

        if ($request->from && $request->to) {
            $query->whereBetween('applied_at', [
                $request->from,
                $request->to,
            ]);
        }

        return response()->json([
            'data' => $query->paginate($request->per_page ?? 10),
        ]);
    }

    // detail lamaran beserta data pelamar
    public function show($id)
    {
        $application = Application::with([
            'applicant.educations',
            'applicant.experiences',
            'applicant.skills',
            'lowongan',
        ])->findOrFail($id);

        return response()->json(['data' => $application]);
    }

    // update status lamaran
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,review,interview,offered,accepted,rejected',
            'notes'  => 'nullable|string',
        ]);

        $application = Application::findOrFail($id);
        $application->update([
            'status' => $request->status,
            'notes'  => $request->notes,
        ]);

        return response()->json([
            'message' => 'Status berhasil diperbarui.',
            'data'    => $application,
        ]);
    }

    // hapus lamaran
    public function destroy($id)
    {
        Application::findOrFail($id)->delete();

        return response()->json(['message' => 'Lamaran berhasil dihapus.']);
    }
}
