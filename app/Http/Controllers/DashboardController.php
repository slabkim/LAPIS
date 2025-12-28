<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\PengaduanPungliCalo;
use App\Models\PengaduanKeterlambatan;

class DashboardController extends Controller
{
    public function index(): View
    {
        $pungli = PengaduanPungliCalo::where('id_user', Auth::id())->with('layanan')->latest()->get();
        $keterlambatan = PengaduanKeterlambatan::where('id_user', Auth::id())->with('layanan')->latest()->get();

        return view('dashboard', compact('pungli', 'keterlambatan'));
    }
}
