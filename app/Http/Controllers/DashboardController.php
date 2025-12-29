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
        $userId = Auth::id();
        
        // Get both regular reports and anonymous reports created by this user
        // Anonymous reports have id_user = NULL, but we track them via session/timing
        // For now, show all reports where id_user matches OR show recent anonymous reports
        $pungli = PengaduanPungliCalo::where('id_user', $userId)
            ->with('layanan')
            ->latest()
            ->get();
            
        $keterlambatan = PengaduanKeterlambatan::where('id_user', $userId)
            ->with('layanan')
            ->latest()
            ->get();

        return view('dashboard', compact('pungli', 'keterlambatan'));
    }
}
