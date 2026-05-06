@extends('layouts.admin')

@section('title', 'Rekam Medis')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Rekam Medis Semua Mahasiswa</h1>
        <p class="page-subtitle">Total: {{ $records->total() }} data rekam medis</p>
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
                    <th>Detak Jantung</th>
                    <th>Tensi</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th>Tanggal</th>
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
        {{ $records->links() }}
    </div>
</div>
@endsection
