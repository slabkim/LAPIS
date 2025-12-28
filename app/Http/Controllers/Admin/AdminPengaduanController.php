<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengaduanPungliCalo;
use App\Models\PengaduanKeterlambatan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminPengaduanController extends Controller
{
    public function indexPungli(): View
    {
        $pengaduan = PengaduanPungliCalo::with(['user', 'layanan'])
            ->latest()
            ->paginate(10);
            
        return view('admin.pengaduan.pungli.index', compact('pengaduan'));
    }

    public function showPungli($id): View
    {
        $pengaduan = PengaduanPungliCalo::with(['user', 'layanan', 'lampiran'])->findOrFail($id);
        return view('admin.pengaduan.pungli.show', compact('pengaduan'));
    }

    public function indexKeterlambatan(): View
    {
        $pengaduan = PengaduanKeterlambatan::with(['user', 'layanan'])
            ->latest()
            ->paginate(10);
            
        return view('admin.pengaduan.keterlambatan.index', compact('pengaduan'));
    }
    
    public function showKeterlambatan($id): View
    {
        $pengaduan = PengaduanKeterlambatan::with(['user', 'layanan', 'lampiran'])->findOrFail($id);
        return view('admin.pengaduan.keterlambatan.show', compact('pengaduan'));
    }

    public function updateStatus(Request $request, $type, $id)
    {
        $request->validate([
            'status_pengaduan' => 'required|in:Pending,Proses,Selesai,Ditolak',
        ]);

        if ($type === 'pungli') {
            $pengaduan = PengaduanPungliCalo::findOrFail($id);
        } elseif ($type === 'keterlambatan') {
            $pengaduan = PengaduanKeterlambatan::findOrFail($id);
        } else {
            abort(404);
        }

        $pengaduan->update(['status_pengaduan' => $request->status_pengaduan]);

        return redirect()->back()->with('status', 'Status pengaduan berhasil diperbarui!');
    }
}
