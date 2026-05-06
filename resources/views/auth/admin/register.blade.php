{{-- resources/views/auth/admin/register.blade.php --}}
{{-- Form register admin — dilindungi kunci rahasia dari .env --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Admin</title>
    <style>
        body { background: #f3f4f6; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card { background: #fff; border-radius: 12px; padding: 2rem; width: 100%; max-width: 420px; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        .badge { display: inline-block; background: #EDE9FE; color: #4C1D95; font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px; margin-bottom: 1rem; }
        h1 { font-size: 20px; font-weight: 600; margin-bottom: 4px; }
        p.sub { font-size: 13px; color: #6b7280; margin-bottom: 1.5rem; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 5px; }
        input { width: 100%; padding: 9px 12px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 8px; outline: none; }
        input:focus { border-color: #7C3AED; box-shadow: 0 0 0 3px rgba(124,58,237,.1); }
        .key-input { border-color: #F59E0B; background: #FFFBEB; }
        .key-input:focus { border-color: #D97706; box-shadow: 0 0 0 3px rgba(217,119,6,.1); }
        .key-hint { font-size: 12px; color: #92400E; margin-top: 4px; }
        .btn { width: 100%; padding: 10px; background: #7C3AED; color: #fff; font-size: 14px; font-weight: 600; border: none; border-radius: 8px; cursor: pointer; margin-top: 4px; }
        .btn:hover { background: #6D28D9; }
        .error { background: #FEF2F2; color: #991B1B; font-size: 13px; padding: 10px 12px; border-radius: 8px; margin-bottom: 1rem; border: 1px solid #FECACA; }
        .divider { height: 1px; background: #f3f4f6; margin: 1.25rem 0; }
        .back-link { text-align: center; font-size: 12px; color: #9ca3af; margin-top: 1.25rem; }
        .back-link a { color: #7C3AED; text-decoration: none; }
    </style>
</head>
<body>
<div class="card">
    <span class="badge">Daftar Admin</span>
    <h1>Buat Akun Admin</h1>
    <p class="sub">Hanya bisa dilakukan dengan kunci registrasi yang valid.</p>

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="/setup-admin">
        @csrf

        {{-- Kunci Rahasia — wajib diisi, dicocokkan dengan ADMIN_REGISTER_KEY di .env --}}
        <div class="form-group">
            <label for="register_key">Kunci Registrasi Admin</label>
            <input type="password" id="register_key" name="register_key" class="key-input" placeholder="Masukkan kunci rahasia" required>
            <p class="key-hint">Kunci ini dipegang oleh tim internal. Jangan bagikan.</p>
        </div>

        <div class="divider"></div>

        <div class="form-group">
            <label for="nim">NIM</label>
            <input type="text" id="nim" name="nim" value="{{ old('nim') }}" placeholder="NIM admin" required>
        </div>
        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Nama admin" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="admin@domain.com" required>
        </div>
        <div class="form-group">
            <label for="password">Password (min. 8 karakter)</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required>
        </div>

        <button type="submit" class="btn">Buat Akun Admin</button>
    </form>

    <p class="back-link"><a href="{{ route('admin.login') }}">← Kembali ke login admin</a></p>
</div>
</body>
</html>
