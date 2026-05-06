@extends('layouts.superadmin')

@section('title', 'Statistik')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Statistik Sistem</h1>
        <p class="page-subtitle">Ringkasan data keseluruhan</p>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card stat-blue">
        <div class="stat-icon">👤</div>
        <div class="stat-info">
            <div class="stat-number">{{ $stats['total_users'] }}</div>
            <div class="stat-label">Total Mahasiswa</div>
        </div>
    </div>
    <div class="stat-card stat-orange">
        <div class="stat-icon">🛡️</div>
        <div class="stat-info">
            <div class="stat-number">{{ $stats['total_admins'] }}</div>
            <div class="stat-label">Total Admin</div>
        </div>
    </div>
    <div class="stat-card stat-green">
        <div class="stat-icon">🩺</div>
        <div class="stat-info">
            <div class="stat-number">{{ $stats['total_health'] }}</div>
            <div class="stat-label">Rekam Medis</div>
        </div>
    </div>
    <div class="stat-card stat-purple">
        <div class="stat-icon">😴</div>
        <div class="stat-info">
            <div class="stat-number">{{ $stats['total_sleep'] }}</div>
            <div class="stat-label">Data Tidur</div>
        </div>
    </div>
</div>

<div class="cards-row">
    {{-- Rata-rata tidur --}}
    <div class="card card-half">
        <div class="card-header">
            <h2 class="card-title">😴 Rata-rata Durasi Tidur</h2>
        </div>
        <div class="big-stat">
            @php
                $avgMinutes = $stats['avg_sleep'] ?? 0;
                $avgH = floor($avgMinutes / 60);
                $avgM = $avgMinutes % 60;
            @endphp
            <span class="big-number">{{ $avgH }}j {{ $avgM }}m</span>
            <span class="big-label">per mahasiswa</span>
        </div>
        <div class="sleep-note">
            @if($avgH >= 7)
                <span class="status-badge status-normal">✅ Durasi tidur cukup</span>
            @else
                <span class="status-badge status-rendah">⚠️ Durasi tidur kurang dari ideal</span>
            @endif
        </div>
    </div>

    {{-- Pendaftaran per bulan --}}
    <div class="card card-half">
        <div class="card-header">
            <h2 class="card-title">📅 Pendaftaran per Bulan</h2>
        </div>
        @php
            $bulan = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            $max   = $stats['users_per_month']->max() ?: 1;
        @endphp
        <div class="bar-chart">
            @foreach($stats['users_per_month'] as $month => $count)
            <div class="bar-item">
                <div class="bar-label">{{ $bulan[$month] ?? $month }}</div>
                <div class="bar-wrap">
                    <div class="bar-fill" style="width: {{ ($count / $max) * 100 }}%">
                        <span class="bar-value">{{ $count }}</span>
                    </div>
                </div>
            </div>
            @endforeach
            @if($stats['users_per_month']->isEmpty())
                <p class="empty-state">Belum ada data pendaftaran.</p>
            @endif
        </div>
    </div>
</div>
@endsection
