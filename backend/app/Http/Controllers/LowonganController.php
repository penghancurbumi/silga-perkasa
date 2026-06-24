<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function destroy($id)
    {
        $lowongan = \App\Models\Lowongan::findOrFail($id);
        $lowongan->delete();

        return redirect()->route('lowongan')->with('success', 'Lowongan berhasil dihapus.');
    }
}
