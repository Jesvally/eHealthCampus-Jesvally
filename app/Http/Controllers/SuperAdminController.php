<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HealthRecord;
use App\Models\sleepRecord;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SuperAdminController extends Controller
{
    // Dashboard Super Admin
    public function index()
    {
        $totalUsers      = User::where('role', 'user')->count();
        $totalAdmins     = User::where('role', 'admin')->count();
        $totalRecords    = HealthRecord::count();
        $totalSleep      = sleepRecord::count();
        $recentUsers     = User::where('role', 'user')->latest()->take(5)->get();

        return view('superadmin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'totalRecords',
            'totalSleep',
            'recentUsers'
        ));
    }

    // ==================== MANAJEMEN USER ====================
    public function users()
    {
        $users = User::where('role', 'user')->latest()->paginate(10);
        return view('superadmin.users', compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }

    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'password' => Hash::make('password123'),
        ]);

        return back()->with('success', "Password {$user->name} berhasil direset ke 'password123'.");
    }

    public function changeRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:user,admin,super_admin',
        ]);

        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa mengubah role diri sendiri.');
        }

        $user->update(['role' => $request->role]);
        return back()->with('success', "Role {$user->name} berhasil diubah.");
    }

    // ==================== MANAJEMEN ADMIN ====================
    public function admins()
    {
        $admins = User::where('role', 'admin')->latest()->paginate(10);
        return view('superadmin.admins', compact('admins'));
    }

    public function deleteAdmin($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();
        return back()->with('success', 'Admin berhasil dihapus.');
    }

    // ==================== MONITORING DATA ====================
    public function healthRecords(Request $request)
    {
        $query = HealthRecord::with('user')->latest();

        if ($request->filter_type === 'tanggal' && $request->tanggal) {
            $query->whereDate('created_at', $request->tanggal);
        }

        if ($request->filter_type === 'bulan' && $request->bulan) {
            $query->whereYear('created_at', Carbon::parse($request->bulan)->year)
                  ->whereMonth('created_at', Carbon::parse($request->bulan)->month);
        }

        $records = $query->paginate(10)->withQueryString();

        return view('superadmin.health-records', compact('records'));
    }

    public function sleepRecords(Request $request)
    {
        $query = sleepRecord::with('user')->latest();

        if ($request->filter_type === 'tanggal' && $request->tanggal) {
            $query->whereDate('created_at', $request->tanggal);
        }

        if ($request->filter_type === 'bulan' && $request->bulan) {
            $query->whereYear('created_at', Carbon::parse($request->bulan)->year)
                  ->whereMonth('created_at', Carbon::parse($request->bulan)->month);
        }

        $records = $query->paginate(10)->withQueryString();

        return view('superadmin.sleep-records', compact('records'));
    }

    // ==================== STATISTIK ====================
    public function statistics()
    {
        $stats = [
            'total_users'        => User::where('role', 'user')->count(),
            'total_admins'       => User::where('role', 'admin')->count(),
            'total_health'       => HealthRecord::count(),
            'total_sleep'        => sleepRecord::count(),
            'avg_sleep'          => sleepRecord::selectRaw('AVG(TIMESTAMPDIFF(MINUTE, sleep_time, wake_time)) as avg_duration')->value('avg_duration') ?? 0,
            'users_per_month'    => User::where('role', 'user')
                                        ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                                        ->groupBy('month')
                                        ->pluck('count', 'month'),
        ];

        return view('superadmin.statistics', compact('stats'));
    }
}