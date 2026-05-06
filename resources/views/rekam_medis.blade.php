@extends('layouts.app')

@section('content')
    {{-- ===== SIDEBAR ===== --}}
    <div class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-box">❤️</div>
            <h3>E-Health</h3>
        </div>
        <nav>
            <a href="{{ route('dashboard') }}" class="nav-item">🏠 Dashboard</a>
            <a href="{{ route('rekam-medis') }}" class="nav-item active">📁 Medical Records</a>
            <a href="{{ route('sleep.index') }}" class="nav-item">🛏️ Sleep Tracker</a>
            <a href="{{ route('profile') }}" class="nav-item">👤 Profile</a>
            <div class="nav-bottom">
                <form action="{{ route('logout') }}" method="POST" style="margin:0; padding:0;">
                    @csrf
                    <button type="submit" class="nav-item" style="background:none; border:none; cursor:pointer; width:100%; text-align:left; color:rgba(255,255,255,0.7); font-size:14px; font-weight:600;">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </nav>
    </div>

    {{-- ===== MAIN CONTENT ===== --}}
    <div class="main-content">
        <header class="top-header">
            <div>
                <h1>Medical Records 📁</h1>
                <p>Comprehensive history of your health checks.</p>
            </div>
            <button onclick="window.print()" class="print-btn">🖨️ Print Report</button>
        </header>

        {{-- ===== SUMMARY STATS ===== --}}
        @php
            $totalRecords  = $history->count();
            $healthyCount  = $history->where('status','Healthy')->count();
            $avgDetak      = $totalRecords > 0 ? round($history->avg('detak')) : 0;
            $healthyPct    = $totalRecords > 0 ? round($healthyCount / $totalRecords * 100) : 0;
        @endphp

        <div class="stats-grid" style="grid-template-columns: repeat(3,1fr); margin-bottom:25px;">
            <div class="stat-card border-info">
                <p>Total Records</p>
                <h2>{{ $totalRecords }}</h2>
                <span class="stat-indicator indicator-info">All time</span>
            </div>
            <div class="stat-card border-normal">
                <p>Healthy Rate</p>
                <h2>{{ $healthyPct }}<span style="font-size:16px;color:#a4b0be;">%</span></h2>
                <span class="stat-indicator indicator-normal">{{ $healthyCount }} / {{ $totalRecords }} records</span>
            </div>
            <div class="stat-card {{ $avgDetak >= 60 && $avgDetak <= 100 ? 'border-normal' : 'border-warn' }}">
                <p>Avg Heart Rate</p>
                <h2>{{ $avgDetak > 0 ? $avgDetak : '--' }} <span style="font-size:14px;color:#a4b0be;">Bpm</span></h2>
                <span class="stat-indicator {{ $avgDetak >= 60 && $avgDetak <= 100 ? 'indicator-normal' : 'indicator-warn' }}">
                    {{ $avgDetak >= 60 && $avgDetak <= 100 ? '✓ Normal range' : '⚠ Check needed' }}
                </span>
            </div>
        </div>

        {{-- ===== HEART RATE TREND CHART ===== --}}
        @if($history->count() > 1)
        <div class="content-card">
            <div class="card-header"><h3>📈 Heart Rate Trend</h3></div>
            <div class="chart-container">
                <canvas id="heartRateChart"></canvas>
            </div>
        </div>
        @endif

        {{-- ===== RECORDS TABLE ===== --}}
        <div class="content-card">
            <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:20px;">
                <div>
                    <h3 style="font-size:16px; font-weight:700;">{{ auth()->user()->name }}</h3>
                    <p style="font-size:13px; color:#a4b0be; margin-top:2px;">ID: {{ auth()->user()->nim }}</p>
                </div>
                <span style="font-size:12px; color:#a4b0be;">{{ $totalRecords }} total records</span>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Heart Rate</th>
                        <th>Blood Pressure</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if($history->isEmpty())
                        <tr>
                            <td colspan="4" style="text-align:center; padding:50px; color:#a4b0be;">
                                <div style="font-size:32px; margin-bottom:10px;">📭</div>
                                No records found. Go to dashboard to add your first health check!
                            </td>
                        </tr>
                    @else
                        @foreach($history as $item)
                            <tr>
                                <td style="color:#636e72;">{{ $item->created_at->format('d M Y, H:i') }}</td>
                                <td>
                                    <span style="font-weight:700; color:{{ ($item->detak>=60 && $item->detak<=100) ? '#2ecc71' : '#e74c3c' }}">
                                        {{ $item->detak }} Bpm
                                    </span>
                                </td>
                                <td>{{ $item->tensi }}</td>
                                <td>
                                    <span class="status-tag {{ $item->status=='Healthy' ? 'tag-safe' : 'tag-warn' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    {{-- Chart.js --}}
    @if($history->count() > 1)
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const labels  = @json($history->sortBy('created_at')->pluck('created_at')->map(fn($d) => \Carbon\Carbon::parse($d)->format('d M')));
        const data    = @json($history->sortBy('created_at')->pluck('detak'));

        new Chart(document.getElementById('heartRateChart'), {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label: 'Heart Rate (Bpm)',
                    data,
                    borderColor: '#26a69a',
                    backgroundColor: 'rgba(38,166,154,0.08)',
                    borderWidth: 2.5,
                    pointBackgroundColor: data.map(v => v >= 60 && v <= 100 ? '#26a69a' : '#e74c3c'),
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    tension: 0.4,
                    fill: true,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: ctx => ` ${ctx.parsed.y} Bpm`
                        }
                    }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { size: 12 }, color: '#a4b0be' } },
                    y: {
                        min: 40, max: 140,
                        grid: { color: '#f1f2f6' },
                        ticks: { font: { size: 12 }, color: '#a4b0be', callback: v => v + ' bpm' }
                    }
                }
            }
        });
    </script>
    @endif
@endsection