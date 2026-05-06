@extends('layouts.superadmin')

@section('title', 'Kelola Mahasiswa')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Kelola Mahasiswa</h1>
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
                    <th>TB / BB</th>
                    <th>Role</th>
                    <th>Aksi</th>
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
                    <td>{{ $user->tb ?? '-' }} cm / {{ $user->bb ?? '-' }} kg</td>
                    <td>
                        <span class="role-badge role-{{ $user->role }}">{{ ucfirst($user->role) }}</span>
                    </td>
                    <td>
                        <div class="action-group">
                            {{-- Ubah Role --}}
                            <form action="{{ route('superadmin.users.change-role', $user->id) }}" method="POST" style="display:inline">
                                @csrf
                                <select name="role" class="select-role" onchange="this.form.submit()">
                                    <option value="user"        {{ $user->role === 'user'        ? 'selected' : '' }}>User</option>
                                    <option value="admin"       {{ $user->role === 'admin'       ? 'selected' : '' }}>Admin</option>
                                    <option value="super_admin" {{ $user->role === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                </select>
                            </form>

                            {{-- Reset Password --}}
                            <form action="{{ route('superadmin.users.reset-password', $user->id) }}" method="POST" style="display:inline"
                                  onsubmit="return confirm('Reset password {{ $user->name }} ke password123?')">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-sm">Reset PW</button>
                            </form>

                            {{-- Hapus --}}
                            <form action="{{ route('superadmin.users.delete', $user->id) }}" method="POST" style="display:inline"
                                  onsubmit="return confirm('Yakin hapus {{ $user->name }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
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
