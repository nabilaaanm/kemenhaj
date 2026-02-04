<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AkunController extends Controller
{
    /**
     * Tampilkan profil akun yang sedang login.
     */
    public function show()
    {
        $sessionUser = Session::get('user');
        if (!$sessionUser) {
            return redirect()->route('login');
        }

        $user = User::findOrFail($sessionUser['id']);
        return view('admin.akun.profil', compact('user'));
    }

    /**
     * Update data profil (nama + avatar).
     */
    public function update(Request $request)
    {
        $sessionUser = Session::get('user');
        if (!$sessionUser) {
            return redirect()->route('login');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'name.required' => 'Nama wajib diisi',
            'avatar.image' => 'File avatar harus berupa gambar',
            'avatar.mimes' => 'Avatar harus berformat JPG, JPEG, PNG, atau WEBP',
            'avatar.max' => 'Ukuran avatar maksimal 2MB',
        ]);

        $user = User::findOrFail($sessionUser['id']);
        $user->name = $request->name;

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $destinationPath = public_path('uploads/avatars');
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $filename = Str::uuid()->toString() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move($destinationPath, $filename);
            $relativePath = 'uploads/avatars/' . $filename;

            if (!empty($user->avatar) && str_starts_with($user->avatar, 'uploads/avatars/')) {
                $oldPath = public_path($user->avatar);
                if (is_file($oldPath)) {
                    unlink($oldPath);
                }
            }

            $user->avatar = $relativePath;
        }

        $user->save();

        Session::put('user', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role ?? 'kontributor',
            'avatar' => $user->avatar,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Hapus foto profil.
     */
    public function destroyAvatar()
    {
        $sessionUser = Session::get('user');
        if (!$sessionUser) {
            return redirect()->route('login');
        }

        $user = User::findOrFail($sessionUser['id']);

        if (!empty($user->avatar) && str_starts_with($user->avatar, 'uploads/avatars/')) {
            $oldPath = public_path($user->avatar);
            if (is_file($oldPath)) {
                unlink($oldPath);
            }
        }

        $user->avatar = null;
        $user->save();

        Session::put('user', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role ?? 'kontributor',
            'avatar' => $user->avatar,
        ]);

        return back()->with('success', 'Foto profil berhasil dihapus.');
    }

    /**
     * Update password akun.
     */
    public function updatePassword(Request $request)
    {
        $sessionUser = Session::get('user');
        if (!$sessionUser) {
            return redirect()->route('login');
        }

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'current_password.required' => 'Password saat ini wajib diisi',
            'password.required' => 'Password baru wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $user = User::findOrFail($sessionUser['id']);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini tidak sesuai.',
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success_password', 'Password berhasil diperbarui.');
    }
}
