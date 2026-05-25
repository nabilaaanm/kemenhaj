<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PenggunaController extends Controller
{
    /**
     * Menampilkan daftar pengguna
     */
    public function index()
    {
        // Pastikan hanya admin yang bisa akses
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }

        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.pengaturan.pengguna', compact('users'));
    }

    /**
     * Menampilkan form tambah pengguna baru
     */
    public function create()
    {
        // Pastikan hanya admin yang bisa akses
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }

        return view('admin.pengaturan.pengguna-create');
    }

    /**
     * Menyimpan pengguna baru
     */
    public function store(Request $request)
    {
        // Pastikan hanya admin yang bisa akses
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:kontributor,editor',
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'role.required' => 'Role wajib dipilih',
            'role.in' => 'Role harus kontributor atau editor',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            return redirect()->route('admin.pengaturan.pengguna')->with('success', 'Pengguna berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan pengguna: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Menampilkan form edit pengguna
     */
    public function edit($email)
    {
        // Pastikan hanya admin yang bisa akses
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }

        $pengguna = User::findOrFail(urldecode($email));
        return view('admin.pengaturan.pengguna-edit', compact('pengguna'));
    }

    /**
     * Update pengguna
     */
    public function update(Request $request, $email)
    {
        // Pastikan hanya admin yang bisa akses
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }

        $pengguna = User::findOrFail(urldecode($email));

        $isAdminAccount = $pengguna->role === 'admin';

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $pengguna->email . ',email|max:255',
            'password' => 'nullable|min:6|confirmed',
        ];

        if (!$isAdminAccount) {
            $rules['role'] = 'required|in:kontributor,editor';
        }

        $request->validate($rules, [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'role.required' => 'Role wajib dipilih',
            'role.in' => 'Role tidak valid',
        ]);

        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'role' => $isAdminAccount ? 'admin' : $request->role,
            ];

            // Update password hanya jika diisi
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $editingSelf = $pengguna->email === $user['email'];

            if ($request->email !== $pengguna->email) {
                User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => $data['password'] ?? $pengguna->password,
                    'role' => $data['role'],
                ]);
                $pengguna->delete();
            } else {
                $pengguna->update($data);
            }

            if ($editingSelf || $request->email === $user['email']) {
                $updatedUser = User::findOrFail($request->email);
                Session::put('user', [
                    'name' => $updatedUser->name,
                    'email' => $updatedUser->email,
                    'role' => $updatedUser->role ?? 'kontributor',
                    'avatar' => $updatedUser->avatar,
                ]);
            }

            return redirect()->route('admin.pengaturan.pengguna')->with('success', 'Pengguna berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui pengguna: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Hapus pengguna
     */
    public function destroy($email)
    {
        // Pastikan hanya admin yang bisa akses
        $user = Session::get('user');
        if (!$user || $user['role'] !== 'admin') {
            abort(403, 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
        }

        try {
            $pengguna = User::findOrFail(urldecode($email));
            
            // Jangan izinkan menghapus diri sendiri
            if ($pengguna->email === $user['email']) {
                return back()->with('error', 'Anda tidak dapat menghapus akun sendiri');
            }

            if ($pengguna->role === 'admin') {
                return back()->with('error', 'Akun admin tidak dapat dihapus.');
            }

            $pengguna->delete();

            return redirect()->route('admin.pengaturan.pengguna')->with('success', 'Pengguna berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus pengguna: ' . $e->getMessage());
        }
    }
}
