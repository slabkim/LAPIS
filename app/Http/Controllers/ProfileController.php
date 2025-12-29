<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\PengaduanPungliCalo;
use App\Models\PengaduanKeterlambatan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $userId = Auth::id();
        
        // Get pengaduan statistics
        $pungli = PengaduanPungliCalo::where('id_user', $userId)->get();
        $keterlambatan = PengaduanKeterlambatan::where('id_user', $userId)->get();
        
        $stats = [
            'total' => $pungli->count() + $keterlambatan->count(),
            'selesai' => $pungli->where('status_pengaduan', 'Selesai')->count() + 
                         $keterlambatan->where('status_pengaduan', 'Selesai')->count(),
            'proses' => $pungli->where('status_pengaduan', 'Diproses')->count() + 
                        $keterlambatan->where('status_pengaduan', 'Diproses')->count(),
            'ditolak' => $pungli->where('status_pengaduan', 'Ditolak')->count() + 
                         $keterlambatan->where('status_pengaduan', 'Ditolak')->count(),
        ];
        
        // Merge and sort history
        $history = collect()
            ->concat($pungli->map(fn($p) => [
                'type' => 'pungli',
                'id' => $p->id_pengaduan,
                'title' => 'Pengaduan Pungli & Calo',
                'date' => $p->created_at,
                'status' => $p->status_pengaduan,
                'icon' => 'gavel'
            ]))
            ->concat($keterlambatan->map(fn($k) => [
                'type' => 'keterlambatan',
                'id' => $k->id_pengaduan,
                'title' => 'Keterlambatan Berkas',
                'date' => $k->created_at,
                'status' => $k->status_pengaduan,
                'icon' => 'schedule_send'
            ]))
            ->sortByDesc('date')
            ->take(10);
        
        return view('profile.edit', [
            'user' => $request->user(),
            'stats' => $stats,
            'history' => $history,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
