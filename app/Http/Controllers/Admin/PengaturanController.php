<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Models\SiteAppearance;
use App\Models\TimKemenhaj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class PengaturanController extends Controller
{
    public function umum()
    {
        return view('admin.pengaturan.umum');
    }

    public function modul()
    {
        return view('admin.pengaturan.modul');
    }

    public function tampilan()
    {
        $appearance = null;
        if (Schema::hasTable('site_appearances')) {
            $appearance = SiteAppearance::first();
            if (!$appearance) {
                $appearance = SiteAppearance::create([
                    'primary_color' => '#ECB176',
                    'mode' => 'light',
                ]);
            }
        }

        return view('admin.pengaturan.tampilan', compact('appearance'));
    }

    public function updateTampilan(Request $request)
    {
        if (!Schema::hasTable('site_appearances')) {
            return back()->with('error', 'Tabel pengaturan tampilan belum tersedia. Jalankan migrasi terlebih dahulu.');
        }

        $request->validate([
            'primary_color' => ['required', 'regex:/^#([A-Fa-f0-9]{6})$/'],
            'mode' => 'required|in:light,dark',
        ], [
            'primary_color.required' => 'Warna utama wajib dipilih',
            'primary_color.regex' => 'Format warna tidak valid',
            'mode.required' => 'Mode tampilan wajib dipilih',
            'mode.in' => 'Mode tampilan tidak valid',
        ]);

        $appearance = SiteAppearance::first();
        $data = $request->only(['primary_color', 'mode']);

        if (!$appearance) {
            SiteAppearance::create($data);
        } else {
            $appearance->update($data);
        }

        return redirect()->route('admin.pengaturan.tampilan')
            ->with('success', 'Pengaturan tampilan berhasil disimpan.');
    }

    public function slideshow()
    {
        return view('admin.pengaturan.slideshow');
    }

    public function pengguna()
    {
        return view('admin.pengaturan.pengguna');
    }

    public function panduan()
    {
        return view('admin.pengaturan.panduan');
    }

    public function profilStruktur()
    {
        $profil = Profil::first();
        $tim = TimKemenhaj::orderBy('urutan')->orderBy('id')->get();
        return view('admin.profil.struktur', compact('profil', 'tim'));
    }

    public function profilKontak()
    {
        $profil = Profil::first();
        return view('admin.profil.kontak', compact('profil'));
    }

    public function updateProfil(Request $request)
    {
        $this->ensureProfilColumns();

        $request->validate([
            'struktur_organisasi' => 'nullable|string',
            'struktur_subjudul' => 'nullable|string|max:255',
            'struktur_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'alamat' => 'nullable|string|max:255',
            'alamat_keterangan' => 'nullable|string|max:255',
            'telepon' => 'nullable|string|max:50',
            'telepon_alt' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|string|max:255',
            'maps_url' => 'nullable|string|max:255',
            'maps_embed' => 'nullable|string|max:2000',
            'maps_embed_kbihu' => 'nullable|string|max:2000',
            'maps_embed_ppiu' => 'nullable|string|max:2000',
            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
        ]);

        $profil = Profil::first();
        $data = $request->only([
            'struktur_organisasi',
            'struktur_subjudul',
            'alamat',
            'alamat_keterangan',
            'telepon',
            'telepon_alt',
            'email',
            'website',
            'maps_url',
            'maps_embed',
            'maps_embed_kbihu',
            'maps_embed_ppiu',
            'facebook',
            'instagram',
            'twitter',
            'youtube',
        ]);

        if ($request->hasFile('struktur_gambar')) {
            $file = $request->file('struktur_gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $targetDir = public_path('storage/struktur');
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $file->move($targetDir, $filename);
            $data['struktur_gambar'] = $filename;

            if ($profil && $profil->struktur_gambar) {
                $oldPath = public_path('storage/struktur/' . $profil->struktur_gambar);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
        }
        
        // Guard against missing columns if migration not applied yet.
        $availableColumns = Schema::getColumnListing('profil');
        $data = array_intersect_key($data, array_flip($availableColumns));

        if (!$profil) {
            $profil = Profil::create($data);
        } else {
            $profil->update($data);
        }

        $redirectTo = $request->input('redirect_to', 'admin.profil.struktur');

        return redirect()->route($redirectTo)
            ->with('success', 'Profil berhasil diperbarui.');
    }

    private function ensureProfilColumns(): void
    {
        $required = [
            'struktur_subjudul',
            'struktur_gambar',
            'alamat_keterangan',
            'telepon_alt',
            'maps_url',
            'maps_embed',
            'maps_embed_kbihu',
            'maps_embed_ppiu',
        ];

        $missing = array_filter($required, function ($column) {
            return !Schema::hasColumn('profil', $column);
        });

        if (empty($missing)) {
            return;
        }

        Schema::table('profil', function (Blueprint $table) use ($missing) {
            if (in_array('struktur_subjudul', $missing, true)) {
                $table->string('struktur_subjudul')->nullable()->after('struktur_organisasi');
            }
            if (in_array('struktur_gambar', $missing, true)) {
                $table->string('struktur_gambar')->nullable()->after('struktur_subjudul');
            }
            if (in_array('alamat_keterangan', $missing, true)) {
                $table->string('alamat_keterangan')->nullable()->after('alamat');
            }
            if (in_array('telepon_alt', $missing, true)) {
                $table->string('telepon_alt')->nullable()->after('telepon');
            }
            if (in_array('maps_url', $missing, true)) {
                $table->string('maps_url')->nullable()->after('email');
            }
            if (in_array('maps_embed', $missing, true)) {
                $table->text('maps_embed')->nullable()->after('maps_url');
            }
            if (in_array('maps_embed_kbihu', $missing, true)) {
                $table->text('maps_embed_kbihu')->nullable()->after('maps_embed');
            }
            if (in_array('maps_embed_ppiu', $missing, true)) {
                $table->text('maps_embed_ppiu')->nullable()->after('maps_embed_kbihu');
            }
        });
    }

    public function updateUmum(Request $request)
    {
        // Simpan pengaturan umum (nama kemenhaj, kota, lambang)
        // Untuk demo, kita simpan ke session atau file config
        // Dalam production, simpan ke database
        
        $request->validate([
            'nama_kemenhaj' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'lambang' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        // Handle upload lambang jika ada
        if ($request->hasFile('lambang')) {
            $file = $request->file('lambang');
            $filename = 'lambang.' . $file->getClientOriginalExtension();
            $file->move(public_path('image'), $filename);
        }

        return redirect()->route('admin.pengaturan.umum')
            ->with('success', 'Pengaturan umum berhasil disimpan.');
    }

    // Tim Kemenhaj CRUD
    public function timStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $data = $request->only(['nama', 'jabatan', 'urutan']);
        $data['urutan'] = $data['urutan'] ?? 0;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/tim'), $filename);
            $data['foto'] = $filename;
        }

        TimKemenhaj::create($data);

        return redirect()->route('admin.pengaturan.profil')
            ->with('success', 'Anggota tim berhasil ditambahkan.');
    }

    public function timUpdate(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'urutan' => 'nullable|integer|min:0',
        ]);

        $tim = TimKemenhaj::findOrFail($id);
        $data = $request->only(['nama', 'jabatan', 'urutan']);
        $data['urutan'] = $data['urutan'] ?? 0;

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($tim->foto && file_exists(public_path('storage/tim/' . $tim->foto))) {
                unlink(public_path('storage/tim/' . $tim->foto));
            }
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/tim'), $filename);
            $data['foto'] = $filename;
        }

        $tim->update($data);

        return redirect()->route('admin.pengaturan.profil')
            ->with('success', 'Anggota tim berhasil diperbarui.');
    }

    public function timDestroy($id)
    {
        $tim = TimKemenhaj::findOrFail($id);
        
        // Hapus foto jika ada
        if ($tim->foto && file_exists(public_path('storage/tim/' . $tim->foto))) {
            unlink(public_path('storage/tim/' . $tim->foto));
        }
        
        $tim->delete();

        return redirect()->route('admin.pengaturan.profil')
            ->with('success', 'Anggota tim berhasil dihapus.');
    }
}
