@extends('layouts.app')

@section('content')
<div class="auth-body">
    <div class="auth-card">

        <h2 class="brand-text">E-Health Campus</h2>
        <p class="auth-subtitle">Selamat datang kembali, Mahasiswa!</p>

        {{-- Flash success (misal: setelah register) --}}
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        {{-- Error validasi --}}
        @if ($errors->any())
            <div class="alert alert-error" role="alert">
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.process') }}" novalidate>
            @csrf

            {{-- Field NIM atau Email --}}
            <div class="form-group">
                <label for="login" class="form-label">NIM atau Email</label>
                <input
                    type="text"
                    id="login"
                    name="login"
                    class="form-input @error('login') input-error @enderror"
                    placeholder="Masukkan NIM atau Email"
                    value="{{ old('login') }}"
                    autocomplete="username"
                    autofocus
                    required
                >
                @error('login')
                    <span class="field-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            {{-- Field Password --}}
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-input @error('password') input-error @enderror"
                    placeholder="Masukkan password"
                    autocomplete="current-password"
                    required
                >
                @error('password')
                    <span class="field-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary btn-block">
                Login
            </button>
        </form>

        <p class="auth-footer">
            Belum punya akun?
            <a href="{{ route('register') }}" class="auth-link">Daftar sekarang</a>
        </p>

    </div>
</div>
@endsection