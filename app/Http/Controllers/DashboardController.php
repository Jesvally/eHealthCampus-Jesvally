<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HealthRecord;

class DashboardController extends Controller
{
    public function index()
    {
        $profile = Auth::user();

        // Ambil data rekam medis user yang login, terbaru di atas
        $history = HealthRecord::where('user_id', auth()->id())
                        ->latest()
                        ->get();

        return view('dashboard', compact('profile', 'history'));
    }
}