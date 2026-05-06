@extends('layouts.superadmin')

@section('title', 'Rekam Medis')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Rekam Medis Semua Mahasiswa</h1>
        <p class="page-subtitle">Total: {{ $records->total() }} data rekam medis</p>
    </div>
</div>

{{-- Filter Form --}}
<div class="card filter-card">
    <form method="GET" action="{{ url()->current() }}" class="filter-form">
        <div class="filter-group">
            <label for="filter_type">Sortir Berdasarkan</label>
            <select name="filter_type" id="filter_type" onchange="toggleFilter(this.value)">
                <option value="">-- Pilih Filter --</option>
                <option value="tanggal" {{ request('filter_type') === 'tanggal' ? 'selected' : '' }}>Tanggal</option>
                <option value="bulan" {{ request('filter_type') === 'bulan' ? 'selected' : '' }}>Bulan</option>
            </select>
        </div>

        {{-- Filter by Tanggal --}}
        <div class="filter-group" id="filter-tanggal" style="display: none;">
            <label for="tanggal">Pilih Tanggal</label>
            <input type="date" name="tanggal" id="tanggal" value="{{ request('tanggal') }}">
        </div>

        {{-- Filter by Bulan --}}
        <div class="filter-group" id="filter-bulan" style="display: none;">
            <label for="bulan">Pilih Bulan & Tahun</label>
            <input type="month" name="bulan" id="bulan" value="{{ request('bulan') }}">
        </div>

        <div class="filter-actions">
            <button type="submit" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                </svg>
                Filter
            </button>
            <a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>
</div>

<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Detak Jantung</th>
                    <th>Tensi</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th>
                        Tanggal
                        @if(request('filter_type') === 'tanggal')
                            <span class="filter-active-badge">📅 {{ \Carbon\Carbon::parse(request('tanggal'))->translatedFormat('d M Y') }}</span>
                        @elseif(request('filter_type') === 'bulan')
                            <span class="filter-active-badge">📅 {{ \Carbon\Carbon::parse(request('bulan'))->translatedFormat('F Y') }}</span>
                        @endif
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($records as $i => $record)
                <tr>
                    <td>{{ $records->firstItem() + $i }}</td>
                    <td><span class="badge-nim">{{ $record->user->nim ?? '-' }}</span></td>
                    <td>{{ $record->user->name ?? '-' }}</td>
                    <td>{{ $record->detak }} bpm</td>
                    <td>{{ $record->tensi }}</td>
                    <td>
                        <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $record->status)) }}">
                            {{ $record->status }}
                        </span>
                    </td>
                    <td>{{ $record->notes ?? '-' }}</td>
                    <td>{{ $record->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="8" class="empty-state">Belum ada rekam medis.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">
        {{ $records->links(null, ['filter_type' => request('filter_type'), 'tanggal' => request('tanggal'), 'bulan' => request('bulan')]) }}
    </div>
</div>

<script>
    function toggleFilter(value) {
        document.getElementById('filter-tanggal').style.display = value === 'tanggal' ? 'flex' : 'none';
        document.getElementById('filter-bulan').style.display = value === 'bulan' ? 'flex' : 'none';
    }

    // Restore filter state on page load
    document.addEventListener('DOMContentLoaded', function () {
        const filterType = document.getElementById('filter_type').value;
        if (filterType) toggleFilter(filterType);
    });
</script>
@endsection