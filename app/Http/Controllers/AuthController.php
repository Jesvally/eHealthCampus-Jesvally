<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // ==================== LOGIN ====================

    public function login()
    {
        return view('auth.login');
    }

    public function processLogin(Request $request)
    {
        $request->validate([
            'login'    => ['required'],
            'password' => ['required'],
        ]);

        $login = $request->login;

        // Deteksi otomatis: pakai email atau nim
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nim';

        if (Auth::attempt([$field => $login, 'password' => $request->password])) {
            $request->session()->regenerate();

            return match(Auth::user()->role) {
                'super_admin' => redirect()->route('superadmin.dashboard'),
                'admin'       => redirect()->route('admin.dashboard'),
                default       => redirect()->route('dashboard'),
            };
        }

        return back()->withErrors([
            'login' => 'NIM/Email atau password salah.',
        ])->onlyInput('login');
    }

    // ==================== REGISTER USER BIASA ====================

    public function register()
    {
        return view('auth.register');
    }

    public function processRegister(Request $request)
    {
        $validated = $request->validate([
            'nim'      => 'required|string|max:20|unique:users',
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'umur'     => 'required|integer|min:1|max:120',
            'height'   => 'nullable|integer|min:1',
            'weight'   => 'nullable|integer|min:1',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'nim'      => $validated['nim'],
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'umur'     => $validated['umur'],
            'tb'       => $validated['height'] ?? null,
            'bb'       => $validated['weight'] ?? null,
            'password' => bcrypt($validated['password']),
            'role'     => 'user',
        ]);

        Auth::attempt(['nim' => $validated['nim'], 'password' => $validated['password']]);

        return redirect()->route('dashboard');
    }

    // ==================== REGISTER ADMIN (URL RAHASIA + KUNCI) ====================

    public function registerAdmin()
    {
        return view('auth.admin.register');
    }

    public function processRegisterAdmin(Request $request)
    {
        $request->validate([
            'register_key' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value !== config('auth.admin_register_key')) {
                        $fail('Kunci registrasi admin tidak valid.');
                    }
                },
            ],
            'nim'      => 'required|string|max:20|unique:users',
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'nim'      => $request->nim,
            'name'     => $request->name,
            'email'    => $request->email,
            'umur'     => 0,
            'tb'       => null,
            'bb'       => null,
            'password' => bcrypt($request->password),
            'role'     => 'admin',
        ]);

        return redirect()->route('login')->with('success', 'Akun admin berhasil dibuat! Silakan login.');
    }

    // ==================== REGISTER SUPER ADMIN (URL RAHASIA + KUNCI LEBIH KUAT) ====================

    public function registerSuperAdmin()
    {
        return view('auth.superadmin.register');
    }

    public function processRegisterSuperAdmin(Request $request)
    {
        $request->validate([
            'register_key' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value !== config('auth.superadmin_register_key')) {
                        $fail('Kunci registrasi super admin tidak valid.');
                    }
                },
            ],
            'nim'      => 'required|string|max:20|unique:users',
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:12|confirmed',
        ]);

        User::create([
            'nim'      => $request->nim,
            'name'     => $request->name,
            'email'    => $request->email,
            'umur'     => 0,
            'tb'       => null,
            'bb'       => null,
            'password' => bcrypt($request->password),
            'role'     => 'super_admin',
        ]);

        return redirect()->route('login')->with('success', 'Akun super admin berhasil dibuat! Silakan login.');
    }

    // ==================== LOGIN ADMIN (halaman terpisah) ====================

    public function loginAdmin()
    {
        return view('auth.admin.login');
    }

    public function processLoginAdmin(Request $request)
    {
        $request->validate([
            'login'    => ['required'],
            'password' => ['required'],
        ]);

        $login = $request->login;

        // Deteksi otomatis: pakai email atau nim
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nim';

        if (Auth::attempt([$field => $login, 'password' => $request->password])) {
            // Pastikan yang login memang admin atau super_admin
            if (!Auth::user()->isAdmin()) {
                Auth::logout();
                return back()->withErrors(['login' => 'Akun ini bukan akun admin.']);
            }

            $request->session()->regenerate();

            return match(Auth::user()->role) {
                'super_admin' => redirect()->route('superadmin.dashboard'),
                default       => redirect()->route('admin.dashboard'),
            };
        }

        return back()->withErrors([
            'login' => 'NIM/Email atau password salah.',
        ])->onlyInput('login');
    }

    // ==================== LOGOUT ====================

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}