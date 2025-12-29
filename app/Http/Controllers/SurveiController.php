<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survei;
use App\Models\JenisLayanan;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SurveiController extends Controller
{
    public function index(): View
    {
        $layanan = JenisLayanan::where('status_aktif', true)->get();
        return view('survei.index', compact('layanan'));
    }

    public function store(Request $request): RedirectResponse
    {
        // Validation handled in frontend mostly via OQPS logic but backend validation needed
        $request->validate([
            'id_layanan' => 'required|exists:jenis_layanan,id_layanan',
            'nilai_informasi' => 'required|integer|min:1|max:5',
            'nilai_kecepatan' => 'required|integer|min:1|max:5',
            'nilai_sikap' => 'required|integer|min:1|max:5',
            'nilai_prosedur' => 'required|integer|min:1|max:5',
        ]);

        $avg = ($request->nilai_informasi + $request->nilai_kecepatan + $request->nilai_sikap + $request->nilai_prosedur) / 4;

        Survei::create([
            'id_user' => Auth::id(),
            'id_layanan' => $request->id_layanan,
            'nilai_informasi' => $request->nilai_informasi,
            'nilai_kecepatan' => $request->nilai_kecepatan,
            'nilai_sikap' => $request->nilai_sikap,
            'nilai_prosedur' => $request->nilai_prosedur,
            'nilai_rata_rata' => $avg,
            'komentar' => $request->komentar,
        ]);

        return redirect()->route('dashboard')->with('status', 'Terima kasih atas survei Anda!');
    }
}
