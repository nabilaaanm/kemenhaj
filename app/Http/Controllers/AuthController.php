<?php

namespace App\Http\Controllers;

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
     * Proses login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Dummy users untuk demo (dalam production, gunakan database)
        // Password hash sudah di-generate sebelumnya
        $users = [
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@kemenhaj.go.id',
                'password' => '$2y$12$bK/Dx5IOhsCZ7DV2fg45AeqgVqkX7Zd1QlqmiCYodcxptMArc.vw2', // password: admin123
                'role' => 'admin',
            ],
            [
                'id' => 2,
                'name' => 'Editor',
                'email' => 'editor@kemenhaj.go.id',
                'password' => '$2y$12$gczohDdT7k50ir/YOcT3ge.mfPMnBwMrvPjejSgUUhRnS/yIHxt/G', // password: editor123
                'role' => 'editor',
            ],
            [
                'id' => 3,
                'name' => 'Kontributor',
                'email' => 'kontributor@kemenhaj.go.id',
                'password' => '$2y$12$bptMUsFfJjhERQT/1MwacO75Zfuz.ttgpJQXon8UZkCngyzxeKlwm', // password: kontributor123
                'role' => 'kontributor',
            ],
        ];

        // Cari user berdasarkan email
        $user = collect($users)->firstWhere('email', $request->email);

        // Verifikasi password
        if ($user && Hash::check($request->password, $user['password'])) {
            // Simpan data user ke session (tanpa password)
            Session::put('user', [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role'],
            ]);

            // Redirect berdasarkan role
            return redirect()->route('admin.dashboard')
                ->with('success', 'Login berhasil! Selamat datang, ' . $user['name']);
        }

        return back()->withErrors([
            'email' => 'Email atau password tidak valid.',
        ])->withInput($request->only('email'));
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
