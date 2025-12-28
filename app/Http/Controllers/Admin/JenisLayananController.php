<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisLayanan;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class JenisLayananController extends Controller
{
    public function index(): View
    {
        $layanan = JenisLayanan::latest()->paginate(10);
        return view('admin.master.jenis_layanan.index', compact('layanan'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'status_aktif' => 'boolean'
        ]);

        JenisLayanan::create([
            'nama_layanan' => $request->nama_layanan,
            'status_aktif' => $request->boolean('status_aktif', true),
        ]);

        return redirect()->back()->with('status', 'Layanan berhasil ditambahkan!');
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'status_aktif' => 'boolean'
        ]);

        $layanan = JenisLayanan::findOrFail($id);
        $layanan->update([
            'nama_layanan' => $request->nama_layanan,
            'status_aktif' => $request->boolean('status_aktif'),
        ]);

        return redirect()->back()->with('status', 'Layanan berhasil diperbarui!');
    }

    public function destroy($id): RedirectResponse
    {
        JenisLayanan::findOrFail($id)->delete();
        return redirect()->back()->with('status', 'Layanan berhasil dihapus!');
    }
}
