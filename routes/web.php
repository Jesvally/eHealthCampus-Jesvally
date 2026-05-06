<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HealthRecordController;
use App\Http\Controllers\SleepController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuperAdminController;

Route::get('/', function () {
    if (auth()->check()) {
        return match(auth()->user()->role) {
            'super_admin' => redirect()->route('superadmin.dashboard'),
            'admin'       => redirect()->route('admin.dashboard'),
            default       => redirect()->route('dashboard'),
        };
    }
    return redirect()->route('login');
});

// ─── Auth Routes User Biasa ────────────────────────────────────────────────
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'processLogin'])->name('login.process');

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'processRegister'])->name('register.process');

// ─── Login Admin (halaman terpisah dari user) ──────────────────────────────
Route::get('admin/login', [AuthController::class, 'loginAdmin'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'processLoginAdmin'])->name('admin.login.process');

// ─── Register Admin & Super Admin (URL rahasia + wajib kunci) ─────────────
// Ganti '/setup-admin' dengan URL acak yang hanya diketahui tim internal
// Contoh: /daftar-admin-x9k2m  (bisa diubah bebas)
Route::get('/setup-admin', [AuthController::class, 'registerAdmin']);
Route::post('/setup-admin', [AuthController::class, 'processRegisterAdmin']);

Route::get('/setup-superadmin', [AuthController::class, 'registerSuperAdmin']);
Route::post('/setup-superadmin', [AuthController::class, 'processRegisterSuperAdmin']);

// ─── Logout ───────────────────────────────────────────────────────────────
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// ─── Routes User Biasa ────────────────────────────────────────────────────
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('rekam-medis', [HealthRecordController::class, 'index'])->name('rekam-medis');
    Route::get('rekam-medis/{id}', [HealthRecordController::class, 'show'])->name('rekam-medis.show');
    Route::post('rekam-medis', [HealthRecordController::class, 'store'])->name('rekam-medis.store');
    Route::get('sleep', [SleepController::class, 'index'])->name('sleep.index');
    Route::post('sleep', [SleepController::class, 'store'])->name('sleep.store');
});

// ─── Routes Admin ─────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin,super_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('users', [AdminController::class, 'users'])->name('users');
    Route::get('rekam-medis', [AdminController::class, 'healthRecords'])->name('health-records');
    Route::get('sleep', [AdminController::class, 'sleepRecords'])->name('sleep-records');
});

// ─── Routes Super Admin ───────────────────────────────────────────────────
Route::middleware(['auth', 'role:super_admin'])->prefix('super-admin')->name('superadmin.')->group(function () {
    Route::get('dashboard', [SuperAdminController::class, 'index'])->name('dashboard');

    // User management
    Route::get('users', [SuperAdminController::class, 'users'])->name('users');
    Route::delete('users/{id}', [SuperAdminController::class, 'deleteUser'])->name('users.delete');
    Route::post('users/{id}/reset-password', [SuperAdminController::class, 'resetPassword'])->name('users.reset-password');
    Route::post('users/{id}/change-role', [SuperAdminController::class, 'changeRole'])->name('users.change-role');

    // Admin management
    Route::get('admins', [SuperAdminController::class, 'admins'])->name('admins');
    Route::delete('admins/{id}', [SuperAdminController::class, 'deleteAdmin'])->name('admins.delete');

    // Monitoring
    Route::get('rekam-medis', [SuperAdminController::class, 'healthRecords'])->name('health-records');
    Route::get('sleep', [SuperAdminController::class, 'sleepRecords'])->name('sleep-records');

    // Statistik
    Route::get('statistik', [SuperAdminController::class, 'statistics'])->name('statistics');
});