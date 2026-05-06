@extends('layouts.admin')

@section('title', 'Data Mahasiswa')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Data Mahasiswa</h1>
        <p class="page-subtitle">Total: {{ $users->total() }} mahasiswa terdaftar</p>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
@endif

<div class="card">
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Umur</th>
                    <th>TB (cm)</th>
                    <th>BB (kg)</th>
                    <th>Bergabung</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $i => $user)
                <tr>
                    <td>{{ $users->firstItem() + $i }}</td>
                    <td><span class="badge-nim">{{ $user->nim }}</span></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->umur }} thn</td>
                    <td>{{ $user->tb ?? '-' }}</td>
                    <td>{{ $user->bb ?? '-' }}</td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="8" class="empty-state">Belum ada mahasiswa terdaftar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">
        {{ $users->links() }}
    </div>
</div>
@endsection
