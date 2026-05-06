<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Ubah dari index() menjadi show() agar sesuai dengan error
    public function show()
    {
        // Ambil data user yang sedang login
        $profile = Auth::user();
        
        // Kirim variabel $profile ke view agar tidak Undefined Variable
        return view('profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        // Validasi input sebelum update
        $request->validate([
            'umur' => 'required|integer',
            'tb'   => 'required|integer',
            'bb'   => 'required|integer',
        ]);

        $user->update([
            'umur' => $request->umur,
            'tb'   => $request->tb,
            'bb'   => $request->bb
        ]);

        return redirect()->route('profile')->with('success', 'Profile updated!');
    }
}