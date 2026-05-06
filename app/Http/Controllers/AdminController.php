<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HealthRecord;
use App\Models\SleepRecord;

class AdminController extends Controller
{
    // Dashboard Admin
    public function index()
    {
        $totalUsers     = User::where('role', 'user')->count();
        $totalRecords   = HealthRecord::count();
        $totalSleep     = SleepRecord::count();
        $recentUsers    = User::where('role', 'user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalRecords',
            'totalSleep',
            'recentUsers'
        ));
    }

    // Lihat semua user
    public function users()
    {
        $users = User::where('role', 'user')->latest()->paginate(10);
        return view('admin.users', compact('users'));
    }

    // Lihat semua rekam medis
    public function healthRecords()
    {
        $records = HealthRecord::with('user')->latest()->paginate(10);
        return view('admin.health-records', compact('records'));
    }

    // Lihat semua sleep record
    public function sleepRecords()
    {
        $records = SleepRecord::with('user')->latest()->paginate(10);
        return view('admin.sleep-records', compact('records'));
    }
}