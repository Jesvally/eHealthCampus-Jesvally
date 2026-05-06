@extends('layouts.superadmin')

@section('title', 'Kelola Admin')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Kelola Admin</h1>
        <p class="page-subtitle">Total: {{ $admins->total() }} admin terdaftar</p>
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
                    <th>Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($admins as $i => $admin)
                <tr>
                    <td>{{ $admins->firstItem() + $i }}</td>
                    <td><span class="badge-nim">{{ $admin->nim }}</span></td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="action-group">
                            {{-- Turunkan jadi user --}}
                            <form action="{{ route('superadmin.users.change-role', $admin->id) }}" method="POST" style="display:inline"
                                  onsubmit="return confirm('Turunkan {{ $admin->name }} menjadi user biasa?')">
                                @csrf
                                <input type="hidden" name="role" value="user">
                                <button type="submit" class="btn btn-warning btn-sm">Jadikan User</button>
                            </form>

                            {{-- Hapus admin --}}
                            <form action="{{ route('superadmin.admins.delete', $admin->id) }}" method="POST" style="display:inline"
                                  onsubmit="return confirm('Yakin hapus admin {{ $admin->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="empty-state">Belum ada admin terdaftar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrap">
        {{ $admins->links() }}
    </div>
</div>
@endsection
