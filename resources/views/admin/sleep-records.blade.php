@extends('layouts.admin')

@section('title', 'Data Tidur')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Data Tidur Semua Mahasiswa</h1>
        <p class="page-subtitle">Total: {{ $records->total() }} data tidur</p>
    </div>
</div>

<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jam Tidur</th>
                    <th>Jam Bangun</th>
                    <th>Durasi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($records as $i => $record)
                @php
                    $sleep    = \Carbon\Carbon::parse($record->sleep_time);
                    $wake     = \Carbon\Carbon::parse($record->wake_time);
                    $diff     = $sleep->diff($wake);
                    $duration = $diff->h . ' jam ' . $diff->i . ' menit';
                @endphp
                <tr>
                    <td>{{ $records->firstItem() + $i }}</td>
                    <td><span class="badge-nim">{{ $record->user->nim ?? '-' }}</span></td>
                    <td>{{ $record->user->name ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->date)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->sleep_time)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->wake_time)->format('H:i') }}</td>
                    <td><span class="duration-badge">{{ $duration }}</span></td>
                </tr>
                @empty
                <tr><td colspan="7" class="empty-state">Belum ada data tidur.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">
        {{ $records->links() }}
    </div>
</div>
@endsection
