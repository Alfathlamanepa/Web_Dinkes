<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan form login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Memproses permintaan login.
     */
public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            
            // PERBAIKAN DISINI: Ubah tujuan redirect ke 'dashboard'
            return redirect()->intended(route('dashboard'))
                             ->with('success', 'Selamat datang! Anda telah berhasil login.');
        }

        return back()->withInput(['username']) 
                     ->withErrors([
                         'username' => 'Email atau Password yang Anda masukkan salah.',
                     ]);
    }
    /**
     * Memproses permintaan logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }
}