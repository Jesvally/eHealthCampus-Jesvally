<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index()
    {
        return view('rekam_medis');
    }

    public function store(Request $request)
    {
        $detak = (int)$request->detak;
        $tensi = $request->tensi;
        $sistolik = (int)explode('/', $tensi)[0];
        $status = ($detak >= 60 && $detak <= 100 && $sistolik >= 90 && $sistolik <= 130) ? "Healthy" : "Unhealthy";
        
        $history = session('history', []);
        array_unshift($history, [
            'tgl' => now()->format('d M Y'),
            'detak' => $detak,
            'tensi' => $tensi,
            'status' => $status
        ]);

        session(['history' => $history]);
        return redirect('dashboard');
    }
}