{{-- resources/views/auth/superadmin/register.blade.php --}}
{{-- Form register SUPER ADMIN — perlindungan lebih ketat --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Super Admin</title>
    <style>
        body { background: #1e1b4b; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card { background: #fff; border-radius: 12px; padding: 2rem; width: 100%; max-width: 420px; box-shadow: 0 4px 24px rgba(0,0,0,.3); }
        .badge { display: inline-block; background: #1e1b4b; color: #C4B5FD; font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px; margin-bottom: 1rem; }
        h1 { font-size: 20px; font-weight: 600; margin-bottom: 4px; }
        p.sub { font-size: 13px; color: #6b7280; margin-bottom: 1.5rem; }
        .warning-box { background: #FEF3C7; border: 1px solid #FCD34D; border-radius: 8px; padding: 10px 12px; font-size: 12px; color: #92400E; margin-bottom: 1.25rem; line-height: 1.5; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 5px; }
        input { width: 100%; padding: 9px 12px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 8px; outline: none; }
        input:focus { border-color: #4338CA; box-shadow: 0 0 0 3px rgba(67,56,202,.1); }
        .key-input { border-color: #EF4444; background: #FFF5F5; }
        .key-input:focus { border-color: #DC2626; box-shadow: 0 0 0 3px rgba(220,38,38,.1); }
        .key-hint { font-size: 12px; color: #991B1B; margin-top: 4px; }
        .btn { width: 100%; padding: 10px; background: #1e1b4b; color: #fff; font-size: 14px; font-weight: 600; border: none; border-radius: 8px; cursor: pointer; margin-top: 4px; }
        .btn:hover { background: #312e81; }
        .error { background: #FEF2F2; color: #991B1B; font-size: 13px; padding: 10px 12px; border-radius: 8px; margin-bottom: 1rem; border: 1px solid #FECACA; }
        .divider { height: 1px; background: #f3f4f6; margin: 1.25rem 0; }
        .back-link { text-align: center; font-size: 12px; color: #9ca3af; margin-top: 1.25rem; }
        .back-link a { color: #4338CA; text-decoration: none; }
    </style>
</head>
<body>
<div class="card">
    <span class="badge">Super Admin</span>
    <h1>Buat Akun Super Admin</h1>
    <p class="sub">Akses tertinggi sistem. Hanya untuk pengelola utama.</p>

    <div class="warning-box">
        Pendaftaran ini membutuhkan <strong>kunci rahasia super admin</strong> yang disimpan di server. Jika Anda bukan bagian dari tim teknis, harap tinggalkan halaman ini.
    </div>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="/setup-superadmin">
        @csrf

        <div class="form-group">
            <label for="register_key">Kunci Registrasi Super Admin</label>
            <input type="password" id="register_key" name="register_key" class="key-input" placeholder="Kunci rahasia dari environment server" required>
            <p class="key-hint">Kunci ini di-set di SUPERADMIN_REGISTER_KEY pada file .env server.</p>
        </div>

        <div class="divider"></div>

        <div class="form-group">
            <label for="nim">NIM</label>
            <input type="text" id="nim" name="nim" value="{{ old('nim') }}" placeholder="NIM super admin" required>
        </div>
        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nama lengkap" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="superadmin@domain.com" required>
        </div>
        <div class="form-group">
            <label for="password">Password (min. 12 karakter)</label>
            <input type="password" id="password" name="password" placeholder="••••••••••••" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••••••" required>
        </div>

        <button type="submit" class="btn">Buat Akun Super Admin</button>
    </form>

    <p class="back-link"><a href="{{ route('login') }}">← Kembali ke halaman login</a></p>
</div>
</body>
</html>
