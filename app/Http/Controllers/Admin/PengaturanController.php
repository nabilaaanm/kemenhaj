<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profil;
use App\Models\SiteAppearance;
use App\Models\SiteSetting;
use App\Models\TimKemenhaj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Schema\Blueprint;

class PengaturanController extends Controller
{
    public function umum()
    {
        $this->ensureSiteSettingsTable();
        $setting = SiteSetting::current();
        $appearance = $this->getOrCreateAppearance();

        return view('admin.pengaturan.umum', compact('setting', 'appearance'));
    }

    public function modul()
    {
        return view('admin.pengaturan.modul');
    }

    public function tampilan()
    {
        return redirect()->route('admin.pengaturan.umum');
    }

    public function updateTampilan(Request $request)
    {
        return $this->updateUmum($request);
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

    public function backup()
    {
        return view('admin.pengaturan.backup');
    }

    public function downloadBackup()
    {
        $connection = DB::connection();
        $dbName = $connection->getDatabaseName();
        $tables = $connection->select('SHOW TABLES');
        if (empty($tables)) {
            return back()->with('error', 'Tidak ada tabel yang dapat dibackup.');
        }

        $firstTable = (array) $tables[0];
        $tableKey = array_key_first($firstTable);
        $filename = 'backup-' . $dbName . '-' . date('Ymd_His') . '.sql';

        return response()->streamDownload(function () use ($connection, $tables, $tableKey, $dbName) {
            $out = fopen('php://output', 'w');
            fwrite($out, "-- Backup Database: {$dbName}\n");
            fwrite($out, "-- Generated at: " . date('Y-m-d H:i:s') . "\n\n");
            fwrite($out, "SET foreign_key_checks = 0;\n\n");

            foreach ($tables as $tableRow) {
                $tableArray = (array) $tableRow;
                $table = $tableArray[$tableKey] ?? null;
                if (!$table) {
                    continue;
                }

                $create = $connection->select("SHOW CREATE TABLE `{$table}`");
                if (!empty($create)) {
                    $createRow = (array) $create[0];
                    $createSql = $createRow['Create Table'] ?? $createRow['Create Table'] ?? null;
                    if ($createSql) {
                        fwrite($out, "\nDROP TABLE IF EXISTS `{$table}`;\n");
                        fwrite($out, $createSql . ";\n\n");
                    }
                }

                $offset = 0;
                $limit = 200;
                while (true) {
                    $rows = $connection->select("SELECT * FROM `{$table}` LIMIT {$limit} OFFSET {$offset}");
                    if (empty($rows)) {
                        break;
                    }

                    $columns = array_keys((array) $rows[0]);
                    $colList = '`' . implode('`,`', $columns) . '`';

                    $valuesSql = [];
                    foreach ($rows as $row) {
                        $rowArray = (array) $row;
                        $values = [];
                        foreach ($columns as $col) {
                            $value = $rowArray[$col] ?? null;
                            if ($value === null) {
                                $values[] = 'NULL';
                            } else {
                                $escaped = addslashes((string) $value);
                                $values[] = "'" . $escaped . "'";
                            }
                        }
                        $valuesSql[] = '(' . implode(',', $values) . ')';
                    }

                    fwrite($out, "INSERT INTO `{$table}` ({$colList}) VALUES\n");
                    fwrite($out, implode(",\n", $valuesSql) . ";\n\n");

                    $offset += $limit;
                }
            }

            fwrite($out, "SET foreign_key_checks = 1;\n");
            fclose($out);
        }, $filename, [
            'Content-Type' => 'application/sql',
        ]);
    }

    public function profilStruktur()
    {
        $profil = Profil::first();
        if (!Schema::hasTable('tim_kemenhaj')) {
            $tim = collect();
        } else {
            $hasBaris = Schema::hasColumn('tim_kemenhaj', 'baris');
            $hasSlot = Schema::hasColumn('tim_kemenhaj', 'slot');
            $hasUrutan = Schema::hasColumn('tim_kemenhaj', 'urutan');
            $query = TimKemenhaj::query();
            if ($hasBaris && $hasSlot) {
                $query->orderByRaw('baris is null, baris')
                    ->orderByRaw('slot is null, slot');
            } elseif ($hasUrutan) {
                $query->orderBy('urutan')->orderBy('nama');
            } else {
                $query->orderBy('nama');
            }
            $tim = $query->get();
        }
        return view('admin.profil.struktur', compact('profil', 'tim'));
    }

    public function profilKontak()
    {
        $profil = Profil::first();
        return view('admin.profil.kontak', compact('profil'));
    }

    public function profilSejarah()
    {
        $profil = Profil::first();
        return view('admin.profil.sejarah', compact('profil'));
    }

    public function profilVisiMisi()
    {
        $profil = Profil::first();
        return view('admin.profil.visi-misi', compact('profil'));
    }

    public function updateProfil(Request $request)
    {
        $this->ensureProfilColumns();

        $request->validate([
            'struktur_organisasi' => 'nullable|string',
            'struktur_subjudul' => 'nullable|string|max:255',
            'struktur_gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'sejarah_judul' => 'nullable|string|max:255',
            'sejarah_subjudul' => 'nullable|string|max:255',
            'sejarah_konten' => 'nullable|string',
            'visi_konten' => 'nullable|string',
            'misi_cards' => 'nullable|array',
            'misi_cards.*.title' => 'nullable|string|max:255',
            'misi_cards.*.description' => 'nullable|string',
            'sejarah_cards' => 'nullable|array',
            'sejarah_cards.*.label' => 'nullable|string|max:255',
            'sejarah_cards.*.period' => 'nullable|string|max:255',
            'sejarah_cards.*.title' => 'nullable|string|max:255',
            'sejarah_cards.*.description' => 'nullable|string',
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
            'whatsapp' => 'nullable|string|max:50',
        ]);

        $profil = Profil::first();
        $redirectTo = $request->input('redirect_to', 'admin.profil.struktur');
        $data = [];

        $pickPresent = function (array $fields) use ($request, &$data): void {
            foreach ($fields as $field) {
                if ($request->exists($field)) {
                    $data[$field] = $request->input($field);
                }
            }
        };

        if (str_contains($redirectTo, 'struktur')) {
            $pickPresent(['struktur_organisasi', 'struktur_subjudul']);

            if ($request->boolean('hapus_struktur_gambar') && !$request->hasFile('struktur_gambar')) {
                if ($profil && $profil->struktur_gambar) {
                    Storage::disk('struktur')->delete($profil->struktur_gambar);
                }
                $data['struktur_gambar'] = null;
            }

            if ($request->hasFile('struktur_gambar')) {
                $file = $request->file('struktur_gambar');
                $filename = time() . '_' . $file->getClientOriginalName();
                Storage::disk('struktur')->putFileAs('', $file, $filename);
                $data['struktur_gambar'] = $filename;

                if ($profil && $profil->struktur_gambar) {
                    Storage::disk('struktur')->delete($profil->struktur_gambar);
                }
            }
        } elseif (str_contains($redirectTo, 'sejarah')) {
            $pickPresent(['sejarah_judul', 'sejarah_subjudul', 'sejarah_konten']);

            $cards = collect($request->input('sejarah_cards', []))
                ->map(function ($card) {
                    return [
                        'label' => trim((string) ($card['label'] ?? '')),
                        'period' => trim((string) ($card['period'] ?? '')),
                        'title' => trim((string) ($card['title'] ?? '')),
                        'description' => trim((string) ($card['description'] ?? '')),
                    ];
                })
                ->filter(function ($card) {
                    return $card['label'] !== ''
                        || $card['period'] !== ''
                        || $card['title'] !== ''
                        || $card['description'] !== '';
                })
                ->values()
                ->all();

            if ($request->has('sejarah_cards')) {
                $data['sejarah_konten'] = !empty($cards)
                    ? json_encode($cards, JSON_UNESCAPED_UNICODE)
                    : null;
            }
        } elseif (str_contains($redirectTo, 'visi-misi')) {
            if ($request->exists('visi_konten')) {
                $data['visi_konten'] = $request->input('visi_konten');
            }

            $misiCards = collect($request->input('misi_cards', []))
                ->map(function ($card) {
                    return [
                        'title' => trim((string) ($card['title'] ?? '')),
                        'description' => trim((string) ($card['description'] ?? '')),
                    ];
                })
                ->filter(function ($card) {
                    return $card['title'] !== '' || $card['description'] !== '';
                })
                ->values()
                ->all();

            if ($request->has('misi_cards')) {
                $data['misi_konten'] = !empty($misiCards)
                    ? json_encode($misiCards, JSON_UNESCAPED_UNICODE)
                    : null;
            }
        } elseif (str_contains($redirectTo, 'kontak')) {
            $pickPresent([
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
                'whatsapp',
            ]);
        } else {
            $pickPresent([
                'struktur_organisasi',
                'struktur_subjudul',
                'sejarah_judul',
                'sejarah_subjudul',
                'sejarah_konten',
                'visi_konten',
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
                'whatsapp',
            ]);
        }
        
        // Guard against missing columns if migration not applied yet.
        $availableColumns = Schema::getColumnListing('profil');
        $data = array_intersect_key($data, array_flip($availableColumns));

        if (!$profil) {
            $data['kode'] = 'utama';
            $profil = Profil::create($data);
        } elseif (!empty($data)) {
            $profil->update($data);
        }

        return redirect()->route($redirectTo)
            ->with('success', 'Profil berhasil diperbarui.');
    }

    private function ensureProfilColumns(): void
    {
        $required = [
            'struktur_subjudul',
            'struktur_gambar',
            'sejarah_judul',
            'sejarah_subjudul',
            'sejarah_konten',
            'visi_konten',
            'misi_konten',
            'alamat_keterangan',
            'telepon_alt',
            'maps_url',
            'maps_embed',
            'maps_embed_kbihu',
            'maps_embed_ppiu',
            'facebook',
            'instagram',
            'whatsapp',
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
            if (in_array('sejarah_judul', $missing, true)) {
                $table->string('sejarah_judul')->nullable()->after('struktur_gambar');
            }
            if (in_array('sejarah_subjudul', $missing, true)) {
                $table->string('sejarah_subjudul')->nullable()->after('sejarah_judul');
            }
            if (in_array('sejarah_konten', $missing, true)) {
                $table->text('sejarah_konten')->nullable()->after('sejarah_subjudul');
            }
            if (in_array('visi_konten', $missing, true)) {
                $table->text('visi_konten')->nullable()->after('sejarah_konten');
            }
            if (in_array('misi_konten', $missing, true)) {
                $table->text('misi_konten')->nullable()->after('visi_konten');
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
            if (in_array('facebook', $missing, true)) {
                $table->string('facebook')->nullable()->after('maps_embed_ppiu');
            }
            if (in_array('instagram', $missing, true)) {
                $table->string('instagram')->nullable()->after('facebook');
            }
            if (in_array('whatsapp', $missing, true)) {
                $table->string('whatsapp')->nullable()->after('instagram');
            }
        });
    }

    public function updateUmum(Request $request)
    {
        $this->ensureSiteSettingsTable();

        $rules = [
            'nama_kemenhaj' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'lambang' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ];
        $messages = [];

        if (Schema::hasTable('site_appearances')) {
            $rules['primary_color'] = ['required', 'regex:/^#([A-Fa-f0-9]{6})$/'];
            $rules['mode'] = 'required|in:light,dark';
            $messages['primary_color.required'] = 'Warna utama wajib dipilih';
            $messages['primary_color.regex'] = 'Format warna tidak valid';
            $messages['mode.required'] = 'Mode tampilan wajib dipilih';
            $messages['mode.in'] = 'Mode tampilan tidak valid';
        }

        $request->validate($rules, $messages);

        $setting = SiteSetting::current();
        $data = [
            'nama_kemenhaj' => $request->nama_kemenhaj,
            'kota' => $request->kota,
        ];

        if ($request->hasFile('lambang')) {
            $file = $request->file('lambang');
            $filename = 'lambang.' . strtolower($file->getClientOriginalExtension());
            Storage::disk('image')->putFileAs('', $file, $filename);
            $data['lambang'] = $filename;
        }

        $setting->update($data);
        SiteSetting::refreshCache();

        if (Schema::hasTable('site_appearances')) {
            $appearance = SiteAppearance::first();
            $appearanceData = $request->only(['primary_color', 'mode']);

            if (!$appearance) {
                SiteAppearance::create($appearanceData);
            } else {
                $appearance->update($appearanceData);
            }
        }

        return redirect()->route('admin.pengaturan.umum')
            ->with('success', 'Pengaturan umum berhasil disimpan.');
    }

    private function getOrCreateAppearance(): ?SiteAppearance
    {
        if (!Schema::hasTable('site_appearances')) {
            return null;
        }

        $appearance = SiteAppearance::first();
        if (!$appearance) {
            $appearance = SiteAppearance::create([
                'primary_color' => '#ECB176',
                'mode' => 'light',
            ]);
        }

        return $appearance;
    }

    private function ensureSiteSettingsTable(): void
    {
        if (Schema::hasTable('site_settings')) {
            return;
        }

        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kemenhaj')->default('Kementerian Haji dan Umrah');
            $table->string('kota')->default('Kota Cirebon');
            $table->string('lambang')->default('lambang.png');
            $table->timestamps();
        });

        SiteSetting::query()->create(SiteSetting::defaults());
        SiteSetting::refreshCache();
    }

    // Tim Kemenhaj CRUD
    public function timStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'baris' => 'required|integer|min:1|max:7',
            'slot' => 'required|integer|min:1|max:4',
        ]);

        try {
            $data = $request->only(['nama', 'jabatan', 'baris', 'slot']);

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '_' . $file->getClientOriginalName();
                Storage::disk('tim')->putFileAs('', $file, $filename);
                $data['foto'] = $filename;
            }

            TimKemenhaj::create($data);

            return redirect()->route('admin.profil.struktur')
                ->with('success', 'Anggota tim berhasil ditambahkan.');
        } catch (\Throwable $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan anggota tim: ' . $e->getMessage());
        }
    }

    public function timUpdate(Request $request)
    {
        $request->validate([
            'original_nama' => 'required|string|max:255',
            'original_jabatan' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'baris' => 'required|integer|min:1|max:7',
            'slot' => 'required|integer|min:1|max:4',
        ]);

        try {
            $tim = TimKemenhaj::where('nama', $request->input('original_nama'))
                ->where('jabatan', $request->input('original_jabatan'))
                ->firstOrFail();

            $data = $request->only(['nama', 'jabatan', 'baris', 'slot']);

            if ($request->hasFile('foto')) {
                if ($tim->foto) {
                    Storage::disk('tim')->delete($tim->foto);
                }
                $file = $request->file('foto');
                $filename = time() . '_' . $file->getClientOriginalName();
                Storage::disk('tim')->putFileAs('', $file, $filename);
                $data['foto'] = $filename;
            }

            $pkChanged = $data['nama'] !== $tim->nama || $data['jabatan'] !== $tim->jabatan;

            if ($pkChanged) {
                $data['foto'] = $data['foto'] ?? $tim->foto;
                $data['is_active'] = $tim->is_active;
                $tim->delete();
                TimKemenhaj::create($data);
            } else {
                $updateData = [
                    'baris' => $data['baris'],
                    'slot' => $data['slot'],
                ];
                if (isset($data['foto'])) {
                    $updateData['foto'] = $data['foto'];
                }
                $tim->update($updateData);
            }

            return redirect()->route('admin.profil.struktur')
                ->with('success', 'Anggota tim berhasil diperbarui.');
        } catch (\Throwable $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui anggota tim: ' . $e->getMessage());
        }
    }

    public function timDestroy(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
        ]);

        try {
            $tim = TimKemenhaj::where('nama', $request->input('nama'))
                ->where('jabatan', $request->input('jabatan'))
                ->firstOrFail();

            if ($tim->foto) {
                Storage::disk('tim')->delete($tim->foto);
            }

            $tim->delete();

            return redirect()->route('admin.profil.struktur')
                ->with('success', 'Anggota tim berhasil dihapus.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Gagal menghapus anggota tim: ' . $e->getMessage());
        }
    }
}
