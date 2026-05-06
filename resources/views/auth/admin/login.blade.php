{{-- resources/views/auth/admin/login.blade.php --}}
{{-- Halaman login KHUSUS admin & super admin — terpisah dari user biasa --}}

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
   
    <style>
        body { background: #f3f4f6; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
        .card { background: #fff; border-radius: 12px; padding: 2rem; width: 100%; max-width: 400px; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        .badge { display: inline-block; background: #EDE9FE; color: #4C1D95; font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px; margin-bottom: 1rem; }
        h1 { font-size: 20px; font-weight: 600; margin-bottom: 4px; }
        p.sub { font-size: 13px; color: #6b7280; margin-bottom: 1.5rem; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; font-size: 13px; font-weight: 500; color: #374151; margin-bottom: 5px; }
        input { width: 100%; padding: 9px 12px; font-size: 14px; border: 1px solid #d1d5db; border-radius: 8px; outline: none; box-sizing: border-box; }
        input:focus { border-color: #7C3AED; box-shadow: 0 0 0 3px rgba(124,58,237,.1); }
        .input-hint { font-size: 11px; color: #9ca3af; margin-top: 4px; }
        .btn { width: 100%; padding: 10px; background: #7C3AED; color: #fff; font-size: 14px; font-weight: 600; border: none; border-radius: 8px; cursor: pointer; margin-top: 4px; }
        .btn:hover { background: #6D28D9; }
        .error { background: #FEF2F2; color: #991B1B; font-size: 13px; padding: 10px 12px; border-radius: 8px; margin-bottom: 1rem; border: 1px solid #FECACA; }
        .success { background: #F0FDF4; color: #166534; font-size: 13px; padding: 10px 12px; border-radius: 8px; margin-bottom: 1rem; border: 1px solid #BBF7D0; }
        .user-link { text-align: center; font-size: 12px; color: #9ca3af; margin-top: 1.25rem; }
        .user-link a { color: #7C3AED; text-decoration: none; }
    </style>
</head>
<body>
<div class="card">
    <span class="badge">Panel Admin</span>
    <h1>Masuk sebagai Admin</h1>
    <p class="sub">Halaman ini khusus untuk admin dan super admin.</p>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="error">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.process') }}">
        @csrf
        <div class="form-group">
            <label for="login">NIM / Email Admin</label>
            <input type="text" id="login" name="login" value="{{ old('login') }}" placeholder="Masukkan NIM atau Email" required autofocus>
            <p class="input-hint">Bisa menggunakan NIM atau alamat email.</p>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn">Masuk</button>
    </form>

    <p class="user-link">
        Bukan admin? <a href="{{ route('login') }}">Login sebagai user</a>
    </p>
</div>
</body>
</html>