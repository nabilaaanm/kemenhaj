<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

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

        $users = User::orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $adminCount = User::adminCount();

        return view('admin.pengaturan.pengguna', compact('users', 'adminCount'));
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

        $canCreateAdmin = User::canCreateAdmin();
        $roleOptions = User::roleOptions($canCreateAdmin);

        return view('admin.pengaturan.pengguna-create', compact('canCreateAdmin', 'roleOptions'));
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

        $allowedRoles = array_keys(User::roleOptions(User::canCreateAdmin()));

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|min:6|confirmed',
            'role' => ['required', Rule::in($allowedRoles)],
        ], [
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'role.required' => 'Role wajib dipilih',
            'role.in' => 'Role tidak valid',
        ]);

        if ($request->role === 'admin' && !User::canCreateAdmin()) {
            return back()
                ->with('error', 'Kuota akun admin sudah penuh. Maksimal ' . User::MAX_ADMIN_ACCOUNTS . ' akun admin.')
                ->withInput();
        }

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
        $adminCount = User::adminCount();
        $canCreateAdmin = User::canCreateAdmin();
        $isLastAdmin = $pengguna->role === 'admin' && $adminCount <= 1;
        $canChangeRole = !$isLastAdmin;
        $roleOptions = User::roleOptions($canCreateAdmin || $pengguna->role === 'admin');

        return view('admin.pengaturan.pengguna-edit', compact(
            'pengguna',
            'adminCount',
            'canCreateAdmin',
            'isLastAdmin',
            'canChangeRole',
            'roleOptions',
        ));
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
        $adminCount = User::adminCount();
        $isLastAdmin = $pengguna->role === 'admin' && $adminCount <= 1;
        $canCreateAdmin = User::canCreateAdmin();
        $allowedRoles = $isLastAdmin
            ? ['admin']
            : array_keys(User::roleOptions($canCreateAdmin || $pengguna->role === 'admin'));

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $pengguna->email . ',email|max:255',
            'password' => 'nullable|min:6|confirmed',
            'role' => ['required', Rule::in($allowedRoles)],
        ];

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

        $newRole = $request->role;

        if ($newRole === 'admin' && $pengguna->role !== 'admin' && !User::canCreateAdmin()) {
            return back()
                ->with('error', 'Kuota akun admin sudah penuh. Maksimal ' . User::MAX_ADMIN_ACCOUNTS . ' akun admin.')
                ->withInput();
        }

        if ($pengguna->role === 'admin' && $newRole !== 'admin' && $adminCount <= 1) {
            return back()
                ->with('error', 'Tidak dapat mengubah role admin terakhir di sistem.')
                ->withInput();
        }

        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'role' => $newRole,
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

            if ($pengguna->role === 'admin' && User::adminCount() <= 1) {
                return back()->with('error', 'Tidak dapat menghapus admin terakhir di sistem.');
            }

            $pengguna->delete();

            return redirect()->route('admin.pengaturan.pengguna')->with('success', 'Pengguna berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus pengguna: ' . $e->getMessage());
        }
    }
}
