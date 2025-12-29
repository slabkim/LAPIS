<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengaduanPungliCalo;
use App\Models\PengaduanKeterlambatan;
use App\Models\JenisLayanan;
use App\Models\KategoriPengaduan;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PengaduanController extends Controller
{
    // Pungli & Calo Methods
    public function createPungli(): View
    {
        $layanan = JenisLayanan::where('status_aktif', true)->get();
        // Assuming categories are seeded
        return view('pengaduan.pungli.create', compact('layanan'));
    }

    public function storePungli(Request $request): RedirectResponse
    {
        $request->validate([
            'id_layanan' => 'required|exists:jenis_layanan,id_layanan',
            'tanggal_kejadian' => 'required|date',
            'kronologi' => 'required|string',
            'bukti' => 'required|array|min:1',
            'bukti.*' => 'file|mimes:jpeg,png,jpg,gif,svg,mp4,mov,avi,wmv|max:20480', // Max 20MB
        ]);

        $isAnonim = $request->boolean('is_anonim');
        
        $pengaduan = PengaduanPungliCalo::create([
            'id_user' => $isAnonim ? null : Auth::id(),
            'id_layanan' => $request->id_layanan,
            'id_kategori' => $request->id_kategori ?? 1, 
            'tanggal_kejadian' => $request->tanggal_kejadian,
            'nominal' => $request->nominal,
            'kronologi' => $request->kronologi,
            'is_anonim' => $isAnonim,
        ]);

        // Handle File Uploads (Lampiran) - Upload to Supabase Storage
        if ($request->hasFile('bukti')) {
            $supabaseStorage = new \App\Services\SupabaseStorageService();
            
            foreach ($request->file('bukti') as $file) {
                try {
                    // Upload to Supabase Storage
                    $fileUrl = $supabaseStorage->upload($file, 'pengaduan/pungli');
                    
                    // Determine file type
                    $extension = $file->getClientOriginalExtension();
                    $tipeFile = in_array($extension, ['mp4', 'mov', 'avi', 'wmv']) ? 'video' : 'foto';
                    
                    // Store file URL in database
                    $pengaduan->lampiran()->create([
                        'jenis_pengaduan' => 'pungli_calo',
                        'path_file' => $fileUrl,
                        'tipe_file' => $tipeFile,
                    ]);
                } catch (\Exception $e) {
                    // Log error but continue processing other files
                    Log::error('Failed to upload file to Supabase: ' . $e->getMessage());
                }
            }
        }

        return redirect()->route('dashboard')->with('status', 'Pengaduan berhasil dikirim!');
    }

    // Keterlambatan Methods
    public function createKeterlambatan(): View
    {
        $layanan = JenisLayanan::where('status_aktif', true)->get();
        return view('pengaduan.keterlambatan.create', compact('layanan'));
    }

    public function storeKeterlambatan(Request $request): RedirectResponse
    {
         $request->validate([
            'id_layanan' => 'required|exists:jenis_layanan,id_layanan',
            'tenggat_berkas' => 'required|date',
            'bukti' => 'required|array|min:1',
            'bukti.*' => 'file|mimes:jpeg,png,jpg,gif,svg,pdf|max:10240', // Max 10MB
        ]);

        $pengaduan = PengaduanKeterlambatan::create([
            'id_user' => Auth::id(),
            'id_layanan' => $request->id_layanan,
            'tenggat_berkas' => $request->tenggat_berkas,
        ]);

        // Handle File Uploads - Upload to Supabase Storage
        if ($request->hasFile('bukti')) {
            $supabaseStorage = new \App\Services\SupabaseStorageService();
            
            foreach ($request->file('bukti') as $file) {
                try {
                    // Upload to Supabase Storage
                    $fileUrl = $supabaseStorage->upload($file, 'pengaduan/keterlambatan');
                    
                    // Determine file type
                    $extension = $file->getClientOriginalExtension();
                    $tipeFile = $extension === 'pdf' ? 'pdf' : 'foto';
                    
                    // Store file URL in database
                    $pengaduan->lampiran()->create([
                        'jenis_pengaduan' => 'keterlambatan',
                        'path_file' => $fileUrl,
                        'tipe_file' => $tipeFile,
                    ]);
                } catch (\Exception $e) {
                    // Log error but continue processing other files
                    Log::error('Failed to upload file to Supabase: ' . $e->getMessage());
                }
            }
        }

        return redirect()->route('dashboard')->with('status', 'Pengaduan berhasil dikirim!');
    }
}
