@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Dashboard Admin</h1>
        <p class="page-subtitle">Selamat datang, {{ auth()->user()->name }}</p>
    </div>
    <div class="header-date">{{ now()->format('d F Y') }}</div>
</div>

{{-- Stats Cards --}}
<div class="stats-grid">
    <div class="stat-card stat-blue">
        <div class="stat-icon">👤</div>
        <div class="stat-info">
            <div class="stat-number">{{ $totalUsers }}</div>
            <div class="stat-label">Total Mahasiswa</div>
        </div>
    </div>
    <div class="stat-card stat-green">
        <div class="stat-icon">🩺</div>
        <div class="stat-info">
            <div class="stat-number">{{ $totalRecords }}</div>
            <div class="stat-label">Rekam Medis</div>
        </div>
    </div>
    <div class="stat-card stat-purple">
        <div class="stat-icon">😴</div>
        <div class="stat-info">
            <div class="stat-number">{{ $totalSleep }}</div>
            <div class="stat-label">Data Tidur</div>
        </div>
    </div>
</div>

{{-- Recent Users --}}
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Mahasiswa Terbaru</h2>
        <a href="{{ route('admin.users') }}" class="btn-link">Lihat Semua →</a>
    </div>
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Umur</th>
                    <th>Bergabung</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentUsers as $user)
                <tr>
                    <td><span class="badge-nim">{{ $user->nim }}</span></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->umur }} thn</td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="empty-state">Belum ada mahasiswa terdaftar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
