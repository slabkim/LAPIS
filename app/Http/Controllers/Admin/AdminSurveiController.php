<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Survei;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminSurveiController extends Controller
{
    public function index(): View
    {
        $survei = Survei::with('layanan')->latest()->paginate(15);
        
        // Calculate Averages
        $averages = [
            'informasi' => Survei::avg('nilai_informasi'),
            'kecepatan' => Survei::avg('nilai_kecepatan'),
            'sikap' => Survei::avg('nilai_sikap'),
            'prosedur' => Survei::avg('nilai_prosedur'),
            'total' => Survei::avg('nilai_rata_rata'),
            'count' => Survei::count(),
        ];

        return view('admin.survei.index', compact('survei', 'averages'));
    }
}
