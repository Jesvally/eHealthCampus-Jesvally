<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HealthRecord;

class HealthRecordController extends Controller
{
    // Menampilkan data rekam medis
    public function index()
    {
        // Ambil data rekam medis berdasarkan user yang sedang login
        $history = HealthRecord::where('user_id', auth()->id())->latest()->get();
        
        // Kembalikan tampilan dengan data rekam medis yang diambil
        return view('rekam_medis', compact('history'));
    }

    // Menyimpan data rekam medis
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'detak' => 'required|numeric|min:0',
            'tensi' => 'required|regex:/^\d{2,3}\/\d{2,3}$/', // Format yang diharapkan: 120/80
        ]);

        // Menyaring input dari user
        $detak = (int)$validated['detak']; // Detak jantung
        $tensi = $validated['tensi']; // Tekanan darah (format: sistolik/diastolik)
        
        // Cek jika format tensi valid dan bagi menjadi sistolik dan diastolik
        if (strpos($tensi, '/') !== false) {
            list($sistolik, $diastolik) = explode('/', $tensi);
        } else {
            // Jika format tensi tidak sesuai
            return redirect()->back()->withErrors(['tensi' => 'Format tensi harus berupa sistolik/diastolik (misalnya 120/80)']);
        }

        // Menentukan status berdasarkan detak jantung dan tekanan darah
        if ($detak >= 60 && $detak <= 100 && $sistolik >= 90 && $sistolik <= 130 && $diastolik >= 60 && $diastolik <= 80) {
            $status = 'Healthy';
        } else {
            $status = 'Unhealthy';
        }

        // Menyimpan data ke database
        HealthRecord::create([
            'user_id' => auth()->id(),
            'detak'   => $detak,
            'tensi'   => $tensi,
            'status'  => $status,
        ]);

        // Redirect ke halaman dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Data updated!');
    }
}