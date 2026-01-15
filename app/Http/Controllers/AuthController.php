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
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role ?? 'kontributor', // Default role jika null
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
