<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function showLogin()
    {
        // Jika sudah login, redirect ke dashboard
        if (Session::has('user')) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('auth.login');
    }

    /**
     * Menampilkan halaman lupa password
     */
    public function showForgotPassword()
    {
        if (Session::has('user')) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.forgot-password');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Cari user dari database berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Verifikasi password
        if ($user && Hash::check($request->password, $user->password)) {
            // Simpan data user ke session (tanpa password)
            Session::put('user', [
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role ?? 'kontributor', // Default role jika null
                'avatar' => $user->avatar,
            ]);

            // Redirect berdasarkan role
            return redirect()->route('admin.dashboard')
                ->with('success', 'Login berhasil! Selamat datang, ' . $user->name);
        }

        return back()->withErrors([
            'email' => 'Email atau password tidak valid.',
        ])->withInput($request->only('email'));
    }

    /**
     * Proses lupa password (reset sederhana berbasis email)
     */
    public function processForgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password baru wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors([
                'email' => 'Email tidak terdaftar.',
            ])->withInput($request->only('email'));
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login')
            ->with('success', 'Password berhasil direset. Silakan login kembali.');
    }

    /**
     * Proses logout
     */
    public function logout()
    {
        Session::forget('user');
        Session::flush();

        return redirect()->route('login')
            ->with('success', 'Anda telah logout.');
    }
}
