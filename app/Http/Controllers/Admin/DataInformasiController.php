<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BerhakLunas;
use App\Models\Kbihu;
use App\Models\Ppiu;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DataInformasiController extends Controller
{
    // ==================== BERHAK LUNAS ====================
    public function berhakLunasIndex()
    {
        $data = BerhakLunas::orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.data-informasi.berhak-lunas.index', compact('data'));
    }

    public function berhakLunasCreate()
    {
        return view('admin.data-informasi.berhak-lunas.create');
    }

    public function berhakLunasStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_porsi' => 'required|string|max:255',
            'nama_ayah' => 'nullable|string|max:255',
            'status' => 'required|in:Cadangan,Bukan Cadangan',
            'keterangan' => 'nullable|in:Siap Berangkat,Meninggal,Tunda Berangkat, Tersambung, Gak Nyambung',
            'kbihu' => 'nullable|string|max:255',
            'nomor_paspor' => 'nullable|string|max:255',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nomor_porsi.required' => 'Nomor porsi wajib diisi',
            'status.required' => 'Status wajib diisi',
        ]);

        try {
            BerhakLunas::create([
                'nama' => $request->nama,
                'nama_ayah' => $request->nama_ayah,
                'nomor_porsi' => $request->nomor_porsi,
                'status' => $request->status,
                'keterangan' => $request->keterangan,
                'kbihu' => $request->kbihu,
                'nomor_paspor' => $request->nomor_paspor,
                'is_active' => true,
            ]);

            return redirect()->route('admin.data-informasi.berhak-lunas.index')->with('success', 'Data berhak lunas berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage())->withInput();
        }
    }

    public function berhakLunasEdit($id)
    {
        $data = BerhakLunas::findOrFail($id);
        return view('admin.data-informasi.berhak-lunas.edit', compact('data'));
    }

    public function berhakLunasUpdate(Request $request, $id)
    {
        $data = BerhakLunas::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_porsi' => 'required|string|max:255',
            'nama_ayah' => 'nullable|string|max:255',
            'status' => 'required|in:Cadangan,Bukan Cadangan',
            'keterangan' => 'nullable|in:Siap Berangkat,Meninggal,Tunda Berangkat, Tersambung, Gak Nyambung',
            'kbihu' => 'nullable|string|max:255',
            'nomor_paspor' => 'nullable|string|max:255',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nomor_porsi.required' => 'Nomor porsi wajib diisi',
            'status.required' => 'Status wajib diisi',
        ]);

        try {
            $data->update([
                'nama' => $request->nama,
                'nama_ayah' => $request->nama_ayah,
                'nomor_porsi' => $request->nomor_porsi,
                'status' => $request->status,
                'keterangan' => $request->keterangan,
                'kbihu' => $request->kbihu,
                'nomor_paspor' => $request->nomor_paspor,
            ]);

            return redirect()->route('admin.data-informasi.berhak-lunas.index')->with('success', 'Data berhak lunas berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }
    }

    public function berhakLunasDestroy($id)
    {
        try {
            $data = BerhakLunas::findOrFail($id);
            $data->delete();

            return redirect()->route('admin.data-informasi.berhak-lunas.index')->with('success', 'Data berhak lunas berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function berhakLunasImport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ], [
            'file.required' => 'File Excel wajib diunggah',
            'file.mimes' => 'Format file harus .xlsx, .xls, atau .csv',
        ]);

        try {
            $filePath = $request->file('file')->getRealPath();
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = array_values($sheet->toArray(null, true, true, true));

            if (count($rows) < 2) {
                return back()->with('error', 'File tidak memiliki data untuk diimpor.');
            }
            $headerRowIndex = null;
            $bestScore = 0;
            $scanLimit = min(5, count($rows));
            $knownHeaders = [
                'nomor porsi', 'no porsi', 'no. porsi', 'nomor',
                'nama', 'nama jamaah', 'nama jemaah',
                'keterangan', 'ket',
                'kbihu',
                'nomor paspor', 'no paspor', 'no. paspor', 'paspor',
                'nama ayah', 'ayah', 'nm ayah', 'nm_ayah',
                'status',
            ];
            for ($i = 0; $i < $scanLimit; $i++) {
                $candidate = $rows[$i] ?? [];
                $headerMapCandidate = [];
                foreach ($candidate as $col => $value) {
                    $key = $this->normalizeHeader($value);
                    if ($key !== '') {
                        $headerMapCandidate[$key] = $col;
                    }
                }
                $score = 0;
                foreach ($knownHeaders as $header) {
                    if (isset($headerMapCandidate[$this->normalizeHeader($header)])) {
                        $score++;
                    }
                }
                if ($score > $bestScore) {
                    $bestScore = $score;
                    $headerRowIndex = $i;
                }
            }

            if ($headerRowIndex === null || $bestScore === 0) {
                return back()->with('error', 'Header tidak ditemukan. Pastikan file memiliki kolom: Nomor Porsi dan Nama.');
            }

            $headerRow = $rows[$headerRowIndex];
            $rows = array_slice($rows, $headerRowIndex + 1);
            $headerMap = [];
            foreach ($headerRow as $col => $value) {
                $key = $this->normalizeHeader($value);
                if ($key !== '') {
                    $headerMap[$key] = $col;
                }
            }

            $colNomor = $this->resolveColumn($headerMap, ['nomor porsi', 'no porsi', 'no. porsi', 'nomor']);
            $colNama = $this->resolveColumn($headerMap, ['nama', 'nama jamaah', 'nama jemaah']);
            $colKeterangan = $this->resolveColumn($headerMap, ['keterangan', 'ket']);
            $colKbihu = $this->resolveColumn($headerMap, ['kbihu']);
            $colPaspor = $this->resolveColumn($headerMap, ['nomor paspor', 'no paspor', 'no. paspor', 'paspor']);
            $colNamaAyah = $this->resolveColumn($headerMap, ['nama ayah', 'ayah', 'nm ayah', 'nm_ayah']);
            $colStatus = $this->resolveColumn($headerMap, ['status']);

            if ($colNomor === null || $colNama === null) {
                return back()->with('error', 'Kolom wajib tidak ditemukan. Pastikan ada kolom: Nomor Porsi dan Nama.');
            }

            $inserted = 0;
            $skipped = 0;

            foreach ($rows as $row) {
                $nomorPorsi = trim((string) ($row[$colNomor] ?? ''));
                $nama = trim((string) ($row[$colNama] ?? ''));
                $namaAyah = $colNamaAyah ? trim((string) ($row[$colNamaAyah] ?? '')) : '';
                $statusRaw = $colStatus ? strtoupper(trim((string) ($row[$colStatus] ?? ''))) : '';
                $keteranganRaw = $colKeterangan ? strtoupper(trim((string) ($row[$colKeterangan] ?? ''))) : '';
                $kbihu = $colKbihu ? trim((string) ($row[$colKbihu] ?? '')) : '';
                $paspor = $colPaspor ? trim((string) ($row[$colPaspor] ?? '')) : '';

                if ($nama === '' || $nomorPorsi === '') {
                    $skipped++;
                    continue;
                }

                $status = match (true) {
                    $statusRaw === 'CADANGAN' => 'Cadangan',
                    $statusRaw === 'BUKAN CADANGAN' => 'Bukan Cadangan',
                    $statusRaw === 'MENUNGGU' => 'Cadangan',
                    $statusRaw === 'BERHAK LUNAS' => 'Bukan Cadangan',
                    $statusRaw === 'TIDAK BERHAK' => 'Bukan Cadangan',
                    default => 'Cadangan',
                };
                $keterangan = match (true) {
                    $keteranganRaw === '' => null,
                    str_contains($keteranganRaw, 'SIAP') => 'Siap Berangkat',
                    str_contains($keteranganRaw, 'MENINGGAL') => 'Meninggal',
                    str_contains($keteranganRaw, 'TUNDA') => 'Tunda Berangkat',
                    str_contains($keteranganRaw, 'TERSAMBUNG') => 'Tersambung',
                    str_contains($keteranganRaw, 'GAK NYAMBUNG') => 'Gak Nyambung',
                    str_contains($keteranganRaw, 'GAK') => 'Gak Nyambung',
                    str_contains($keteranganRaw, 'NYAMBUNG') => 'Tersambung',
                    default => null,
                };
                BerhakLunas::create([
                    'nama' => $nama,
                    'nama_ayah' => $namaAyah !== '' ? $namaAyah : null,
                    'nomor_porsi' => $nomorPorsi,
                    'status' => $status,
                    'keterangan' => $keterangan,
                    'kbihu' => $kbihu !== '' ? $kbihu : null,
                    'nomor_paspor' => $paspor !== '' ? $paspor : null,
                    'is_active' => true,
                ]);

                $inserted++;
            }

            if ($inserted === 0) {
                return back()->with('error', 'Tidak ada data valid untuk diimpor. Pastikan kolom Nomor Porsi dan Nama terisi.');
            }

            return redirect()->route('admin.data-informasi.berhak-lunas.index')
                ->with('success', "Import selesai: {$inserted} data ditambahkan, {$skipped} baris dilewati.");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }

    // ==================== KBIHU ====================
    public function kbihuIndex()
    {
        $data = Kbihu::orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.data-informasi.kbihu.index', compact('data'));
    }

    public function kbihuCreate()
    {
        return view('admin.data-informasi.kbihu.create');
    }

    public function kbihuStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tahun_berdiri' => 'nullable|string|max:255',
            'nama_pimpinan' => 'nullable|string|max:255',
            'telp' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'maps_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
        ]);

        try {
            $mapsUrl = $this->buildMapsUrl($request->maps_url, $request->latitude, $request->longitude);
            Kbihu::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'tahun_berdiri' => $request->tahun_berdiri,
                'nama_pimpinan' => $request->nama_pimpinan,
                'telp' => $request->telp,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'maps_url' => $mapsUrl,
                'order' => $request->order ?? 0,
                'is_active' => true,
            ]);

            return redirect()->route('admin.data-informasi.kbihu.index')->with('success', 'Data KBIHU berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage())->withInput();
        }
    }

    public function kbihuEdit($id)
    {
        $data = Kbihu::findOrFail($id);
        return view('admin.data-informasi.kbihu.edit', compact('data'));
    }

    public function kbihuUpdate(Request $request, $id)
    {
        $data = Kbihu::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tahun_berdiri' => 'nullable|string|max:255',
            'nama_pimpinan' => 'nullable|string|max:255',
            'telp' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'maps_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
        ]);

        try {
            $mapsUrl = $this->buildMapsUrl($request->maps_url, $request->latitude, $request->longitude);
            $data->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'tahun_berdiri' => $request->tahun_berdiri,
                'nama_pimpinan' => $request->nama_pimpinan,
                'telp' => $request->telp,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'maps_url' => $mapsUrl,
                'order' => $request->order ?? 0,
            ]);

            return redirect()->route('admin.data-informasi.kbihu.index')->with('success', 'Data KBIHU berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }
    }

    public function kbihuDestroy($id)
    {
        try {
            $data = Kbihu::findOrFail($id);
            $data->delete();

            return redirect()->route('admin.data-informasi.kbihu.index')->with('success', 'Data KBIHU berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function kbihuImport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ], [
            'file.required' => 'File Excel wajib diunggah',
            'file.mimes' => 'Format file harus .xlsx, .xls, atau .csv',
        ]);

        try {
            $filePath = $request->file('file')->getRealPath();
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, true);

            if (count($rows) < 2) {
                return back()->with('error', 'File tidak memiliki data untuk diimpor.');
            }

            $headerRow = array_shift($rows);
            $headerMap = [];
            foreach ($headerRow as $col => $value) {
                $key = strtolower(trim((string) $value));
                if ($key !== '') {
                    $headerMap[$key] = $col;
                }
            }

            $colNama = $this->resolveColumn($headerMap, ['nama kbihu', 'nama', 'nama kbi hu']);
            $colAlamat = $this->resolveColumn($headerMap, ['alamat']);
            $colTelp = $this->resolveColumn($headerMap, ['no telp', 'telp', 'telepon', 'no hp', 'no. telp']);
            $colTahun = $this->resolveColumn($headerMap, ['tahun berdiri', 'tahun', 'thn berdiri']);
            $colPimpinan = $this->resolveColumn($headerMap, ['nama pimpinan', 'pimpinan', 'ketua']);
            $colLatitude = $this->resolveColumn($headerMap, ['latitude', 'lat']);
            $colLongitude = $this->resolveColumn($headerMap, ['longitude', 'long', 'lng']);
            $colMaps = $this->resolveColumn($headerMap, ['maps', 'google maps', 'link maps', 'maps url']);
            $colOrder = $this->resolveColumn($headerMap, ['no', 'nomor', 'no.']);

            if (!$colNama || !$colAlamat) {
                $colNama = $colNama ?: 'B';
                $colAlamat = $colAlamat ?: 'C';
                $colTahun = $colTahun ?: 'D';
                $colPimpinan = $colPimpinan ?: 'E';
                $colTelp = $colTelp ?: 'F';
                $colLatitude = $colLatitude ?: 'G';
                $colLongitude = $colLongitude ?: 'H';
            }

            $inserted = 0;
            $skipped = 0;

            foreach ($rows as $row) {
                $nama = trim((string) ($row[$colNama] ?? ''));
                $alamat = trim((string) ($row[$colAlamat] ?? ''));
                $telp = trim((string) ($row[$colTelp] ?? ''));
                $tahun = trim((string) ($row[$colTahun] ?? ''));
                $pimpinan = trim((string) ($row[$colPimpinan] ?? ''));
                $latitude = $colLatitude ? $row[$colLatitude] ?? null : null;
                $longitude = $colLongitude ? $row[$colLongitude] ?? null : null;
                $mapsRaw = $colMaps ? $row[$colMaps] ?? null : null;
                $orderValue = $colOrder ? ($row[$colOrder] ?? null) : null;

                if ($nama === '' && $alamat === '') {
                    $skipped++;
                    continue;
                }

                $order = 0;
                if (is_numeric($orderValue)) {
                    $order = max(0, (int) $orderValue - 1);
                }

                $mapsUrl = $this->buildMapsUrl($mapsRaw, $latitude, $longitude);
                Kbihu::create([
                    'nama' => $nama ?: '-',
                    'alamat' => $alamat ?: '-',
                    'tahun_berdiri' => $tahun !== '' ? $tahun : null,
                    'nama_pimpinan' => $pimpinan !== '' ? $pimpinan : null,
                    'telp' => $telp !== '' ? $telp : null,
                    'latitude' => $latitude !== null && $latitude !== '' ? (float) $latitude : null,
                    'longitude' => $longitude !== null && $longitude !== '' ? (float) $longitude : null,
                    'maps_url' => $mapsUrl,
                    'order' => $order,
                    'is_active' => true,
                ]);

                $inserted++;
            }

            return redirect()->route('admin.data-informasi.kbihu.index')
                ->with('success', "Import selesai: {$inserted} data ditambahkan, {$skipped} baris dilewati.");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }

    private function resolveColumn(array $headerMap, array $aliases): ?string
    {
        foreach ($aliases as $alias) {
            $key = $this->normalizeHeader($alias);
            if (isset($headerMap[$key])) {
                return $headerMap[$key];
            }
        }

        return null;
    }

    private function normalizeHeader($value): string
    {
        $key = strtolower(trim((string) $value));
        $key = preg_replace('/\s+/', ' ', $key) ?? '';
        return trim($key);
    }

    private function buildMapsUrl($mapsUrl, $latitude, $longitude): ?string
    {
        $mapsUrl = is_string($mapsUrl) ? trim($mapsUrl) : '';
        $lat = is_numeric($latitude) ? (float) $latitude : null;
        $lng = is_numeric($longitude) ? (float) $longitude : null;

        if ($mapsUrl !== '') {
            return $mapsUrl;
        }

        if ($lat !== null && $lng !== null) {
            return 'https://www.google.com/maps?q=' . $lat . ',' . $lng;
        }

        return null;
    }

    // ==================== PPIU ====================
    public function ppiuIndex()
    {
        $data = Ppiu::orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.data-informasi.ppiu.index', compact('data'));
    }

    public function ppiuCreate()
    {
        return view('admin.data-informasi.ppiu.create');
    }

    public function ppiuStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'direktur' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:255',
            'terakreditasi' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'maps_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
        ], [
            'nama.required' => 'Nama PPIU wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
        ]);

        try {
            $mapsUrl = $this->buildMapsUrl($request->maps_url, $request->latitude, $request->longitude);
            Ppiu::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'direktur' => $request->direktur,
                'no_telp' => $request->no_telp,
                'terakreditasi' => $request->terakreditasi,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'maps_url' => $mapsUrl,
                'status' => 'Aktif',
                'order' => $request->order ?? 0,
                'is_active' => true,
            ]);

            return redirect()->route('admin.data-informasi.ppiu.index')->with('success', 'Data PPIU berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage())->withInput();
        }
    }

    public function ppiuEdit($id)
    {
        $data = Ppiu::findOrFail($id);
        return view('admin.data-informasi.ppiu.edit', compact('data'));
    }

    public function ppiuUpdate(Request $request, $id)
    {
        $data = Ppiu::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'direktur' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:255',
            'terakreditasi' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'maps_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
        ], [
            'nama.required' => 'Nama PPIU wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
        ]);

        try {
            $mapsUrl = $this->buildMapsUrl($request->maps_url, $request->latitude, $request->longitude);
            $data->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'direktur' => $request->direktur,
                'no_telp' => $request->no_telp,
                'terakreditasi' => $request->terakreditasi,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'maps_url' => $mapsUrl,
                'order' => $request->order ?? 0,
            ]);

            return redirect()->route('admin.data-informasi.ppiu.index')->with('success', 'Data PPIU berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }
    }

    public function ppiuDestroy($id)
    {
        try {
            $data = Ppiu::findOrFail($id);
            $data->delete();

            return redirect()->route('admin.data-informasi.ppiu.index')->with('success', 'Data PPIU berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function ppiuImport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
        ], [
            'file.required' => 'File Excel wajib diunggah',
            'file.mimes' => 'Format file harus .xlsx, .xls, atau .csv',
        ]);

        try {
            $filePath = $request->file('file')->getRealPath();
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, true);

            if (count($rows) < 2) {
                return back()->with('error', 'File tidak memiliki data untuk diimpor.');
            }

            $headerRow = array_shift($rows);
            $headerMap = [];
            foreach ($headerRow as $col => $value) {
                $key = strtolower(trim((string) $value));
                if ($key !== '') {
                    $headerMap[$key] = $col;
                }
            }

            $colNama = $this->resolveColumn($headerMap, ['nama', 'nama ppiu']);
            $colDirektur = $this->resolveColumn($headerMap, ['direktur', 'pimpinan']);
            $colAlamat = $this->resolveColumn($headerMap, ['alamat cabang', 'alamat']);
            $colTelp = $this->resolveColumn($headerMap, ['no telp', 'telp', 'telepon', 'no hp', 'no. telp']);
            $colAkreditasi = $this->resolveColumn($headerMap, ['terakreditasi', 'akreditasi']);
            $colLatitude = $this->resolveColumn($headerMap, ['latitude', 'lat']);
            $colLongitude = $this->resolveColumn($headerMap, ['longitude', 'long', 'lng']);
            $colMaps = $this->resolveColumn($headerMap, ['maps url', 'maps', 'google maps', 'link maps']);
            $colNo = $this->resolveColumn($headerMap, ['no', 'nomor', 'no.']);

            if (!$colNama || !$colAlamat) {
                $colNama = $colNama ?: 'B';
                $colDirektur = $colDirektur ?: 'C';
                $colAlamat = $colAlamat ?: 'D';
                $colTelp = $colTelp ?: 'F';
                $colAkreditasi = $colAkreditasi ?: 'G';
                $colLatitude = $colLatitude ?: 'H';
                $colLongitude = $colLongitude ?: 'I';
                $colMaps = $colMaps ?: 'J';
            }

            $inserted = 0;
            $skipped = 0;

            foreach ($rows as $row) {
                $nama = trim((string) ($row[$colNama] ?? ''));
                $alamat = trim((string) ($row[$colAlamat] ?? ''));
                $direktur = trim((string) ($row[$colDirektur] ?? ''));
                $telp = trim((string) ($row[$colTelp] ?? ''));
                $akreditasi = trim((string) ($row[$colAkreditasi] ?? ''));
                $latitude = $colLatitude ? $row[$colLatitude] ?? null : null;
                $longitude = $colLongitude ? $row[$colLongitude] ?? null : null;
                $mapsRaw = $colMaps ? $row[$colMaps] ?? null : null;
                $noValue = $colNo ? ($row[$colNo] ?? null) : null;

                if ($nama === '' && $alamat === '') {
                    $skipped++;
                    continue;
                }

                $order = 0;
                if (is_numeric($noValue)) {
                    $order = max(0, (int) $noValue - 1);
                }

                $mapsUrl = $this->buildMapsUrl($mapsRaw, $latitude, $longitude);

                Ppiu::create([
                    'nama' => $nama ?: '-',
                    'direktur' => $direktur !== '' ? $direktur : null,
                    'alamat' => $alamat ?: '-',
                    'no_telp' => $telp !== '' ? $telp : null,
                    'terakreditasi' => $akreditasi !== '' ? $akreditasi : null,
                    'latitude' => $latitude !== null && $latitude !== '' ? (float) $latitude : null,
                    'longitude' => $longitude !== null && $longitude !== '' ? (float) $longitude : null,
                    'maps_url' => $mapsUrl,
                    'status' => 'Aktif',
                    'order' => $order,
                    'is_active' => true,
                ]);

                $inserted++;
            }

            return redirect()->route('admin.data-informasi.ppiu.index')
                ->with('success', "Import selesai: {$inserted} data ditambahkan, {$skipped} baris dilewati.");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }
}
