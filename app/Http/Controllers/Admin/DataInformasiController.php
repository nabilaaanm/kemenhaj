<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BerhakLunas;
use App\Models\HajiJamaah;
use App\Models\Kbihu;
use App\Models\Ppiu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DataInformasiController extends Controller
{
    // ==================== BERHAK LUNAS ====================
    public function berhakLunasIndex()
    {
        $search = trim((string) request()->query('q'));
        $query = BerhakLunas::query();
        $statusFilter = trim((string) request()->query('status'));
        if ($search !== '' || $statusFilter !== '') {
            $query->where(function ($q) use ($search) {
                if ($search !== '') {
                    $q->where('nomor_porsi', 'like', '%' . $search . '%')
                        ->orWhere('nama', 'like', '%' . $search . '%')
                        ->orWhere('nomor_paspor', 'like', '%' . $search . '%')
                        ->orWhere('nama_ayah', 'like', '%' . $search . '%')
                        ->orWhere('keterangan', 'like', '%' . $search . '%');
                }
            });
            if ($statusFilter !== '') {
                $query->where('status', $statusFilter);
            }
        }
        $data = $query->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();
        
        return view('admin.data-informasi.berhak-lunas.index', compact('data', 'search', 'statusFilter'));
    }

    public function berhakLunasCreate()
    {
        return view('admin.data-informasi.berhak-lunas.create');
    }

    public function berhakLunasStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_porsi' => 'required|digits:10|unique:berhak_lunas,nomor_porsi',
            'nama_ayah' => 'nullable|string|max:255',
            'status' => 'required|in:Cadangan,Bukan Cadangan',
            'keterangan' => 'nullable|string|max:255',
            'nomor_paspor' => 'nullable|alpha_num|size:8|unique:berhak_lunas,nomor_paspor',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nomor_porsi.required' => 'Nomor porsi wajib diisi',
            'nomor_porsi.digits' => 'Nomor porsi harus 10 digit',
            'nomor_porsi.unique' => 'Nomor porsi sudah terdaftar',
            'nomor_paspor.size' => 'Nomor paspor harus 8 karakter',
            'nomor_paspor.unique' => 'Nomor paspor sudah terdaftar',
            'status.required' => 'Status wajib diisi',
        ]);

        try {
            BerhakLunas::create([
                'nama' => $request->nama,
                'nama_ayah' => $request->nama_ayah,
                'nomor_porsi' => $request->nomor_porsi,
                'status' => $request->status,
                'keterangan' => $request->keterangan,
                'nomor_paspor' => $request->nomor_paspor,
                'is_active' => true,
            ]);

            return redirect()->route('admin.data-informasi.berhak-lunas.index')->with('success', 'Data berhak lunas berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage())->withInput();
        }
    }

    public function berhakLunasEdit($nomor_porsi)
    {
        $data = BerhakLunas::findOrFail($nomor_porsi);
        return view('admin.data-informasi.berhak-lunas.edit', compact('data'));
    }

    public function berhakLunasUpdate(Request $request, $nomor_porsi)
    {
        $data = BerhakLunas::findOrFail($nomor_porsi);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_porsi' => 'required|digits:10|unique:berhak_lunas,nomor_porsi,' . $data->nomor_porsi . ',nomor_porsi',
            'nama_ayah' => 'nullable|string|max:255',
            'status' => 'required|in:Cadangan,Bukan Cadangan',
            'keterangan' => 'nullable|string|max:255',
            'nomor_paspor' => 'nullable|alpha_num|size:8|unique:berhak_lunas,nomor_paspor,' . $data->nomor_porsi . ',nomor_porsi',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nomor_porsi.required' => 'Nomor porsi wajib diisi',
            'nomor_porsi.digits' => 'Nomor porsi harus 10 digit',
            'nomor_porsi.unique' => 'Nomor porsi sudah terdaftar',
            'nomor_paspor.size' => 'Nomor paspor harus 8 karakter',
            'nomor_paspor.unique' => 'Nomor paspor sudah terdaftar',
            'status.required' => 'Status wajib diisi',
        ]);

        try {
            $payload = [
                'nama' => $request->nama,
                'nama_ayah' => $request->nama_ayah,
                'nomor_porsi' => $request->nomor_porsi,
                'status' => $request->status,
                'keterangan' => $request->keterangan,
                'nomor_paspor' => $request->nomor_paspor,
                'is_active' => $data->is_active,
            ];

            if ($request->nomor_porsi !== $data->nomor_porsi) {
                $data->delete();
                BerhakLunas::create($payload);
            } else {
                $data->update($payload);
            }

            return redirect()->route('admin.data-informasi.berhak-lunas.index')->with('success', 'Data berhak lunas berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }
    }

    public function berhakLunasDestroy($nomor_porsi)
    {
        try {
            $data = BerhakLunas::findOrFail($nomor_porsi);
            $data->delete();

            return redirect()->route('admin.data-informasi.berhak-lunas.index')->with('success', 'Data berhak lunas berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function berhakLunasDestroyAll()
    {
        try {
            BerhakLunas::truncate();
            return redirect()->route('admin.data-informasi.berhak-lunas.index')->with('success', 'Semua data berhak lunas berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus semua data: ' . $e->getMessage());
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
            $colPaspor = $this->resolveColumn($headerMap, ['nomor paspor', 'no paspor', 'no. paspor', 'paspor']);
            $colNamaAyah = $this->resolveColumn($headerMap, ['nama ayah', 'ayah', 'nm ayah', 'nm_ayah']);
            $colStatus = $this->resolveColumn($headerMap, ['status']);

            if ($colNomor === null || $colNama === null) {
                return back()->with('error', 'Kolom wajib tidak ditemukan. Pastikan ada kolom: Nomor Porsi dan Nama.');
            }

            $inserted = 0;
            $skipped = 0;
            $duplicates = 0;
            $seenInFile = [];
            $compareFields = ['nama', 'nama_ayah', 'nomor_porsi', 'status', 'keterangan', 'nomor_paspor'];

            foreach ($rows as $row) {
                $nomorPorsi = trim((string) ($row[$colNomor] ?? ''));
                $nama = trim((string) ($row[$colNama] ?? ''));
                $namaAyah = $colNamaAyah ? trim((string) ($row[$colNamaAyah] ?? '')) : '';
                $statusRaw = $colStatus ? strtoupper(trim((string) ($row[$colStatus] ?? ''))) : '';
                $keteranganRaw = $colKeterangan ? trim((string) ($row[$colKeterangan] ?? '')) : '';
                $paspor = $colPaspor ? trim((string) ($row[$colPaspor] ?? '')) : '';

                if ($nama === '' || $nomorPorsi === '') {
                    $skipped++;
                    continue;
                }

                $status = match (true) {
                    $statusRaw === 'CADANGAN' => 'Cadangan',
                    $statusRaw === 'BUKAN CADANGAN' => 'Bukan Cadangan',
                    $statusRaw === 'MURNI' => 'Bukan Cadangan',
                    $statusRaw === 'REGULER' => 'Bukan Cadangan',
                    $statusRaw === 'MENUNGGU' => 'Cadangan',
                    $statusRaw === 'BERHAK LUNAS' => 'Bukan Cadangan',
                    $statusRaw === 'TIDAK BERHAK' => 'Bukan Cadangan',
                    default => 'Cadangan',
                };
                $keterangan = $keteranganRaw !== '' ? $keteranganRaw : null;
                $payload = [
                    'nama' => $nama,
                    'nama_ayah' => $namaAyah !== '' ? $namaAyah : null,
                    'nomor_porsi' => $nomorPorsi,
                    'status' => $status,
                    'keterangan' => $keterangan,
                    'nomor_paspor' => $paspor !== '' ? $paspor : null,
                    'is_active' => true,
                ];

                $fingerprint = $this->importFingerprint($payload, $compareFields);
                if ($this->isDuplicateInFile($fingerprint, $seenInFile)) {
                    $duplicates++;
                    continue;
                }

                $existing = BerhakLunas::find($nomorPorsi);
                if ($existing && $this->modelMatchesImport($existing, $payload, $compareFields)) {
                    $duplicates++;
                    continue;
                }

                if ($existing) {
                    $duplicates++;
                    continue;
                }

                BerhakLunas::create($payload);

                $inserted++;
            }

            return $this->finishImportRedirect('admin.data-informasi.berhak-lunas.index', $inserted, $duplicates, $skipped);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }

    public function berhakLunasTemplate()
    {
        $headers = [
            'Nomor Porsi',
            'Nama',
            'Nama Ayah',
            'Status',
            'Keterangan',
            'Nomor Paspor',
        ];

        return response()->streamDownload(function () use ($headers) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->fromArray($headers, null, 'A1');

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, 'template-berhak-lunas.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    // ==================== KBIHU ====================
    public function kbihuIndex()
    {
        $data = Kbihu::orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();
        
        return view('admin.data-informasi.kbihu.index', compact('data'));
    }

    public function kbihuCreate()
    {
        return view('admin.data-informasi.kbihu.create');
    }

    public function kbihuStore(Request $request)
    {
        $this->mergeNormalizedCoordinates($request);

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'tahun_berdiri' => 'nullable|string|max:255',
            'nama_pimpinan' => 'nullable|string|max:255',
            'telp' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'maps_url' => 'nullable|string|max:255',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
        ]);

        try {
            $mapsUrl = $this->buildMapsUrl($request->maps_url, $request->latitude, $request->longitude);
            $nextOrder = ((int) Kbihu::max('order')) + 1;
            Kbihu::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'tahun_berdiri' => $request->tahun_berdiri,
                'nama_pimpinan' => $request->nama_pimpinan,
                'telp' => $request->telp,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'maps_url' => $mapsUrl,
                'order' => $nextOrder,
                'is_active' => true,
            ]);

            return redirect()->route('admin.data-informasi.kbihu.index')->with('success', 'Data KBIHU berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage())->withInput();
        }
    }

    public function kbihuEdit($nama)
    {
        $data = Kbihu::findOrFail(urldecode($nama));
        return view('admin.data-informasi.kbihu.edit', compact('data'));
    }

    public function kbihuUpdate(Request $request, $nama)
    {
        $data = Kbihu::findOrFail(urldecode($nama));

        $this->mergeNormalizedCoordinates($request);

        $request->validate([
            'nama' => 'required|string|max:255|unique:kbihu,nama,' . $data->nama . ',nama',
            'alamat' => 'required|string',
            'tahun_berdiri' => 'nullable|string|max:255',
            'nama_pimpinan' => 'nullable|string|max:255',
            'telp' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'maps_url' => 'nullable|string|max:255',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.unique' => 'Nama KBIHU sudah terdaftar',
            'alamat.required' => 'Alamat wajib diisi',
        ]);

        try {
            $mapsUrl = $this->buildMapsUrl($request->maps_url, $request->latitude, $request->longitude);
            $payload = [
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'tahun_berdiri' => $request->tahun_berdiri,
                'nama_pimpinan' => $request->nama_pimpinan,
                'telp' => $request->telp,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'maps_url' => $mapsUrl,
                'order' => $data->order,
                'is_active' => $data->is_active,
            ];

            if ($request->nama !== $data->nama) {
                $data->delete();
                Kbihu::create($payload);
            } else {
                $data->update($payload);
            }

            return redirect()->route('admin.data-informasi.kbihu.index')->with('success', 'Data KBIHU berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }
    }

    public function kbihuDestroy($nama)
    {
        try {
            $data = Kbihu::findOrFail(urldecode($nama));
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
            $duplicates = 0;
            $seenInFile = [];
            $compareFields = ['nama', 'alamat', 'tahun_berdiri', 'nama_pimpinan', 'telp', 'latitude', 'longitude', 'maps_url'];

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
                $payload = [
                    'nama' => $nama ?: '-',
                    'alamat' => $alamat ?: '-',
                    'tahun_berdiri' => $tahun !== '' ? $tahun : null,
                    'nama_pimpinan' => $pimpinan !== '' ? $pimpinan : null,
                    'telp' => $telp !== '' ? $telp : null,
                    'latitude' => $this->parseCoordinate($latitude),
                    'longitude' => $this->parseCoordinate($longitude),
                    'maps_url' => $mapsUrl,
                    'order' => $order,
                    'is_active' => true,
                ];

                $fingerprint = $this->importFingerprint($payload, $compareFields);
                if ($this->isDuplicateInFile($fingerprint, $seenInFile)) {
                    $duplicates++;
                    continue;
                }

                $existing = Kbihu::find($payload['nama']);
                if ($existing && $this->modelMatchesImport($existing, $payload, $compareFields)) {
                    $duplicates++;
                    continue;
                }

                if ($existing) {
                    $duplicates++;
                    continue;
                }

                Kbihu::create($payload);

                $inserted++;
            }

            return $this->finishImportRedirect('admin.data-informasi.kbihu.index', $inserted, $duplicates, $skipped);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }

    public function kbihuTemplate()
    {
        $headers = [
            'Nama KBIHU',
            'Alamat',
            'Tahun Berdiri',
            'Nama Pimpinan',
            'No Telp',
            'Latitude',
            'Longitude',
            'Link Maps',
        ];

        return response()->streamDownload(function () use ($headers) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->fromArray($headers, null, 'A1');

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, 'template-kbihu.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
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
        $lat = $this->parseCoordinate($latitude);
        $lng = $this->parseCoordinate($longitude);

        if ($mapsUrl !== '') {
            return $mapsUrl;
        }

        if ($lat !== null && $lng !== null) {
            return 'https://www.google.com/maps?q=' . $lat . ',' . $lng;
        }

        return null;
    }

    private function normalizeCoordinate($value): ?string
    {
        if ($value === null) {
            return null;
        }

        $normalized = trim((string) $value);
        if ($normalized === '') {
            return null;
        }

        return str_replace(',', '.', $normalized);
    }

    private function parseCoordinate($value): ?float
    {
        $normalized = $this->normalizeCoordinate($value);
        if ($normalized === null || !is_numeric($normalized)) {
            return null;
        }

        return (float) $normalized;
    }

    private function mergeNormalizedCoordinates(Request $request): void
    {
        $request->merge([
            'latitude' => $this->normalizeCoordinate($request->input('latitude')),
            'longitude' => $this->normalizeCoordinate($request->input('longitude')),
        ]);
    }

    private function normalizeImportValue($value): string
    {
        if ($value === null) {
            return '';
        }

        if (is_bool($value)) {
            return $value ? '1' : '0';
        }

        if (is_int($value) || is_float($value)) {
            $normalized = rtrim(rtrim(sprintf('%.10F', (float) $value), '0'), '.');

            return $normalized === '' ? '0' : $normalized;
        }

        return mb_strtolower(trim(preg_replace('/\s+/', ' ', (string) $value) ?? ''));
    }

    private function importFingerprint(array $data, array $fields): string
    {
        $parts = [];
        foreach ($fields as $field) {
            $parts[] = $field . '=' . $this->normalizeImportValue($data[$field] ?? null);
        }

        return implode('|', $parts);
    }

    private function modelMatchesImport($model, array $data, array $fields): bool
    {
        foreach ($fields as $field) {
            if ($this->normalizeImportValue($model->{$field} ?? null) !== $this->normalizeImportValue($data[$field] ?? null)) {
                return false;
            }
        }

        return true;
    }

    private function isDuplicateInFile(string $fingerprint, array &$seenInFile): bool
    {
        if (isset($seenInFile[$fingerprint])) {
            return true;
        }

        $seenInFile[$fingerprint] = true;

        return false;
    }

    private function finishImportRedirect(string $route, int $inserted, int $duplicates, int $skipped)
    {
        if ($inserted === 0 && $duplicates === 0) {
            return redirect()->route($route)->with('error', 'Tidak ada data valid untuk diimpor.');
        }

        if ($inserted === 0 && $duplicates > 0) {
            return redirect()->route($route)->with('error', "Import tidak menambahkan data. {$duplicates} data duplikat (sudah ada di sistem).");
        }

        $message = "Import selesai: {$inserted} data baru ditambahkan";
        if ($duplicates > 0) {
            $message .= ", {$duplicates} data duplikat dilewati";
        }
        if ($skipped > 0) {
            $message .= ", {$skipped} baris kosong dilewati";
        }
        $message .= '.';

        return redirect()->route($route)->with('success', $message);
    }

    private function generatePpiuNoIzin(): string
    {
        do {
            $noIzin = 'AUTO-' . strtoupper(Str::random(8));
        } while (Ppiu::where('no_izin', $noIzin)->exists());

        return $noIzin;
    }

    // ==================== PPIU ====================
    public function ppiuIndex()
    {
        $data = Ppiu::orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();
        
        return view('admin.data-informasi.ppiu.index', compact('data'));
    }

    public function ppiuCreate()
    {
        return view('admin.data-informasi.ppiu.create');
    }

    public function ppiuStore(Request $request)
    {
        $this->mergeNormalizedCoordinates($request);

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'direktur' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:255',
            'terakreditasi' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'maps_url' => 'nullable|string|max:255',
        ], [
            'nama.required' => 'Nama PPIU wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
        ]);

        try {
            $mapsUrl = $this->buildMapsUrl($request->maps_url, $request->latitude, $request->longitude);
            $nextOrder = ((int) Ppiu::max('order')) + 1;
            $payload = [
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'direktur' => $request->direktur,
                'no_telp' => $request->no_telp,
                'terakreditasi' => $request->terakreditasi,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'maps_url' => $mapsUrl,
                'status' => 'Aktif',
                'order' => $nextOrder,
                'is_active' => true,
            ];

            if (Schema::hasColumn('ppiu', 'no_izin')) {
                $payload['no_izin'] = $this->generatePpiuNoIzin();
            }

            Ppiu::create($payload);

            return redirect()->route('admin.data-informasi.ppiu.index')->with('success', 'Data PPIU berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menambahkan data: ' . $e->getMessage())->withInput();
        }
    }

    public function ppiuEdit($no_izin)
    {
        $data = Ppiu::findOrFail(urldecode($no_izin));
        return view('admin.data-informasi.ppiu.edit', compact('data'));
    }

    public function ppiuUpdate(Request $request, $no_izin)
    {
        $data = Ppiu::findOrFail(urldecode($no_izin));

        $this->mergeNormalizedCoordinates($request);

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'direktur' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:255',
            'terakreditasi' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'maps_url' => 'nullable|string|max:255',
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
            ]);

            return redirect()->route('admin.data-informasi.ppiu.index')->with('success', 'Data PPIU berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage())->withInput();
        }
    }

    public function ppiuDestroy($no_izin)
    {
        try {
            $data = Ppiu::findOrFail(urldecode($no_izin));
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
            $colNoIzin = $this->resolveColumn($headerMap, ['no izin', 'nomor izin', 'no. izin', 'no izin ppiu']);

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
            $duplicates = 0;
            $seenInFile = [];
            $compareFields = ['no_izin', 'nama', 'direktur', 'alamat', 'no_telp', 'terakreditasi', 'latitude', 'longitude', 'maps_url', 'status'];

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
                $noIzin = $colNoIzin ? trim((string) ($row[$colNoIzin] ?? '')) : '';

                if ($nama === '' && $alamat === '') {
                    $skipped++;
                    continue;
                }

                $order = 0;
                if (is_numeric($noValue)) {
                    $order = max(0, (int) $noValue - 1);
                }

                $mapsUrl = $this->buildMapsUrl($mapsRaw, $latitude, $longitude);

                $payload = [
                    'nama' => $nama ?: '-',
                    'direktur' => $direktur !== '' ? $direktur : null,
                    'alamat' => $alamat ?: '-',
                    'no_telp' => $telp !== '' ? $telp : null,
                    'terakreditasi' => $akreditasi !== '' ? $akreditasi : null,
                    'latitude' => $this->parseCoordinate($latitude),
                    'longitude' => $this->parseCoordinate($longitude),
                    'maps_url' => $mapsUrl,
                    'status' => 'Aktif',
                    'order' => $order,
                    'is_active' => true,
                ];

                $fingerprintPayload = $payload;
                if (Schema::hasColumn('ppiu', 'no_izin')) {
                    $fingerprintPayload['no_izin'] = $noIzin;
                }

                $fingerprint = $this->importFingerprint($fingerprintPayload, $compareFields);
                if ($this->isDuplicateInFile($fingerprint, $seenInFile)) {
                    $duplicates++;
                    continue;
                }

                $existing = null;
                if ($noIzin !== '' && Schema::hasColumn('ppiu', 'no_izin')) {
                    $existing = Ppiu::find($noIzin);
                }
                if (!$existing) {
                    $existing = Ppiu::where('nama', $payload['nama'])
                        ->where('alamat', $payload['alamat'])
                        ->first();
                }

                if ($existing && $this->modelMatchesImport($existing, $fingerprintPayload, $compareFields)) {
                    $duplicates++;
                    continue;
                }

                if ($existing) {
                    $duplicates++;
                    continue;
                }

                if ($noIzin === '' && Schema::hasColumn('ppiu', 'no_izin')) {
                    $noIzin = $this->generatePpiuNoIzin();
                }

                if (Schema::hasColumn('ppiu', 'no_izin')) {
                    $payload['no_izin'] = $noIzin;
                }

                Ppiu::create($payload);

                $inserted++;
            }

            return $this->finishImportRedirect('admin.data-informasi.ppiu.index', $inserted, $duplicates, $skipped);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }

    public function ppiuTemplate()
    {
        $headers = [
            'No Izin',
            'Nama',
            'Direktur',
            'Alamat Cabang',
            'No Telp',
            'Terakreditasi',
            'Latitude',
            'Longitude',
            'Maps Url',
        ];

        return response()->streamDownload(function () use ($headers) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->fromArray($headers, null, 'A1');

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, 'template-ppiu.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    // ==================== STATISTIK ====================
    public function statistikIndex()
    {
        $total = HajiJamaah::count();
        $lastUpdatedRaw = HajiJamaah::max('updated_at');
        $lastUpdated = $lastUpdatedRaw ? \Illuminate\Support\Carbon::parse($lastUpdatedRaw) : null;
        $tahunTersedia = HajiJamaah::whereNotNull('tahun_keberangkatan')
            ->distinct()
            ->orderBy('tahun_keberangkatan', 'desc')
            ->pluck('tahun_keberangkatan')
            ->map(fn ($v) => (int) $v)
            ->values();

        $tahunMin = $tahunTersedia->isNotEmpty() ? $tahunTersedia->min() : null;
        $tahunMax = $tahunTersedia->isNotEmpty() ? $tahunTersedia->max() : null;

        return view('admin.data-informasi.statistik.index', compact(
            'total',
            'lastUpdated',
            'tahunTersedia',
            'tahunMin',
            'tahunMax',
        ));
    }

    public function statistikImport(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv',
            'force_year' => 'nullable|integer|min:1900|max:2100',
        ], [
            'file.required' => 'File Excel wajib diunggah',
            'file.mimes' => 'Format file harus .xlsx, .xls, atau .csv',
        ]);

        try {
            $forceYear = $request->filled('force_year') ? (int) $request->input('force_year') : null;

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
                $key = strtolower(preg_replace('/\s+/', ' ', trim((string) $value)));
                if ($key !== '') {
                    $headerMap[$key] = $col;
                }
            }

            $aliases = [
                'nomor_porsi' => ['nomor porsi', 'no porsi', 'nomor_porsi', 'no_porsi', 'no. porsi'],
                'nama' => ['nama calon haji', 'nama', 'nama jamaah'],
                'pendidikan' => ['pendidikan', 'pendidikan terakhir'],
                'kbihu' => ['kbihu', 'kbi hu', 'kbiha', 'kelompok bimbingan'],
                'alamat' => ['alamat'],
                'kelurahan' => ['kelurahan', 'desa'],
                'kecamatan' => ['kecamatan'],
                'usia' => ['usia', 'umur'],
                'jenis_kelamin' => ['jenis kelamin', 'jk', 'kelamin'],
                'tahun_keberangkatan' => ['tahun keberangkatan', 'tahun berangkat', 'tahun'],
            ];

            $colIndex = [];
            foreach ($aliases as $field => $keys) {
                foreach ($keys as $key) {
                    if (isset($headerMap[$key])) {
                        $colIndex[$field] = $headerMap[$key];
                        break;
                    }
                }
            }

            $inserted = 0;
            $skipped = 0;
            $preparedRows = [];

            foreach ($rows as $row) {
                $getValue = function ($field) use ($colIndex, $row) {
                    $col = $colIndex[$field] ?? null;
                    return $col ? $row[$col] ?? null : null;
                };

                $nomorPorsi = $this->normalizeImportNomorPorsi($getValue('nomor_porsi'));
                $nama = trim((string) ($getValue('nama') ?? ''));

                if ($nomorPorsi === null) {
                    $skipped++;
                    continue;
                }

                $pendidikan = trim((string) ($getValue('pendidikan') ?? ''));
                $kbihu = trim((string) ($getValue('kbihu') ?? ''));
                $alamat = trim((string) ($getValue('alamat') ?? ''));
                $kelurahan = trim((string) ($getValue('kelurahan') ?? ''));
                $kecamatan = trim((string) ($getValue('kecamatan') ?? ''));
                $usiaRaw = $getValue('usia');
                $usia = is_numeric($usiaRaw) ? (int) $usiaRaw : null;

                $jkRaw = strtolower(trim((string) ($getValue('jenis_kelamin') ?? '')));
                $jenisKelamin = null;
                if ($jkRaw !== '') {
                    if (Str::startsWith($jkRaw, ['l', 'lk']) || str_contains($jkRaw, 'laki') || str_contains($jkRaw, 'pria')) {
                        $jenisKelamin = 'Laki-laki';
                    } elseif (Str::startsWith($jkRaw, ['p']) || str_contains($jkRaw, 'perempuan') || str_contains($jkRaw, 'wanita')) {
                        $jenisKelamin = 'Perempuan';
                    } else {
                        $jenisKelamin = Str::title($jkRaw);
                    }
                }

                $tahunRaw = $getValue('tahun_keberangkatan');
                $tahun = is_numeric($tahunRaw) ? (int) $tahunRaw : null;
                if ($forceYear !== null) {
                    $tahun = $forceYear;
                }

                $data = [
                    'nomor_porsi' => $nomorPorsi,
                    'nama' => $nama !== '' ? $nama : null,
                    'pendidikan' => $pendidikan !== '' ? Str::upper($pendidikan) : null,
                    'kbihu' => $kbihu !== '' ? $kbihu : null,
                    'alamat' => $alamat !== '' ? $alamat : null,
                    'kelurahan' => $kelurahan !== '' ? Str::title($kelurahan) : null,
                    'kecamatan' => $kecamatan !== '' ? Str::title($kecamatan) : null,
                    'usia' => $usia,
                    'jenis_kelamin' => $jenisKelamin,
                    'tahun_keberangkatan' => $tahun,
                ];
                $preparedRows[] = $data;
            }

            $preparedRows = array_values(array_filter(
                $preparedRows,
                fn (array $row) => !empty($row['nomor_porsi'])
            ));

            if (count($preparedRows) === 0) {
                return back()->with('error', 'Tidak ada data valid untuk diimpor. Pastikan kolom terisi dengan benar.');
            }

            $yearsToReplace = $forceYear !== null
                ? [$forceYear]
                : collect($preparedRows)
                    ->pluck('tahun_keberangkatan')
                    ->filter()
                    ->unique()
                    ->values()
                    ->all();

            $importResult = DB::transaction(function () use ($yearsToReplace, $preparedRows) {
                $deletedCount = 0;
                $inserted = 0;
                $duplicates = 0;

                if (!empty($yearsToReplace)) {
                    $deletedCount = HajiJamaah::whereIn('tahun_keberangkatan', $yearsToReplace)->delete();
                }

                $nomorPorsiInFile = collect($preparedRows)
                    ->pluck('nomor_porsi')
                    ->filter(fn ($value) => $value !== null && $value !== '')
                    ->unique()
                    ->values()
                    ->all();

                if (!empty($nomorPorsiInFile)) {
                    $deletedCount += HajiJamaah::whereIn('nomor_porsi', $nomorPorsiInFile)->delete();
                }

                $seenNomorPorsi = [];

                foreach ($preparedRows as $data) {
                    $nomorPorsi = $this->normalizeImportNomorPorsi($data['nomor_porsi'] ?? null);

                    if ($nomorPorsi === null) {
                        continue;
                    }

                    if (isset($seenNomorPorsi[$nomorPorsi])) {
                        $duplicates++;
                        continue;
                    }
                    $seenNomorPorsi[$nomorPorsi] = true;

                    $record = new HajiJamaah();
                    $record->nomor_porsi = $nomorPorsi;
                    $record->fill([
                        'nama' => $data['nama'] ?? null,
                        'pendidikan' => $data['pendidikan'] ?? null,
                        'kbihu' => $data['kbihu'] ?? null,
                        'alamat' => $data['alamat'] ?? null,
                        'kelurahan' => $data['kelurahan'] ?? null,
                        'kecamatan' => $data['kecamatan'] ?? null,
                        'usia' => $data['usia'] ?? null,
                        'jenis_kelamin' => $data['jenis_kelamin'] ?? null,
                        'tahun_keberangkatan' => $data['tahun_keberangkatan'] ?? null,
                    ]);
                    $record->save();
                    $inserted++;
                }

                return compact('deletedCount', 'inserted', 'duplicates');
            });

            $inserted = $importResult['inserted'];
            $duplicates = $importResult['duplicates'];
            $deletedCount = $importResult['deletedCount'];

            if ($inserted === 0 && $duplicates === 0) {
                return redirect()->route('admin.data-informasi.statistik.index')
                    ->with('error', 'Tidak ada data valid untuk diimpor.');
            }

            $yearLabel = count($yearsToReplace) === 1
                ? (string) $yearsToReplace[0]
                : implode(', ', $yearsToReplace);

            $message = $deletedCount > 0
                ? "Import selesai: data tahun {$yearLabel} diganti ({$deletedCount} baris lama dihapus)"
                : 'Import selesai';

            $message .= ", {$inserted} data diimpor";
            if ($duplicates > 0) {
                $message .= ", {$duplicates} duplikat dalam file dilewati";
            }
            if ($skipped > 0) {
                $message .= ", {$skipped} baris kosong dilewati";
            }
            $message .= '.';

            return redirect()->route('admin.data-informasi.statistik.index')->with('success', $message);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }

    public function statistikDeleteYear(Request $request)
    {
        $request->validate([
            'tahun' => 'required|integer|min:1900|max:2100',
        ], [
            'tahun.required' => 'Tahun wajib dipilih',
            'tahun.integer' => 'Tahun tidak valid',
        ]);

        $year = (int) $request->input('tahun');
        $deleted = HajiJamaah::where('tahun_keberangkatan', $year)->delete();

        return back()->with('success', "Data tahun {$year} berhasil dihapus ({$deleted} baris).");
    }

    public function statistikTemplate()
    {
        $headers = [
            'Nomor Porsi',
            'Nama Calon Haji',
            'Pendidikan',
            'KBIHU',
            'Alamat',
            'Kelurahan',
            'Kecamatan',
            'Usia',
            'Jenis Kelamin',
            'Tahun Keberangkatan',
        ];

        return response()->streamDownload(function () use ($headers) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->fromArray($headers, null, 'A1');

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, 'template-statistik-haji.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    public function statistikExportAll(Request $request)
    {
        $tahunTersedia = HajiJamaah::whereNotNull('tahun_keberangkatan')
            ->distinct()
            ->orderBy('tahun_keberangkatan', 'desc')
            ->pluck('tahun_keberangkatan')
            ->map(fn ($v) => (int) $v)
            ->values()
            ->all();

        $request->validate([
            'tahun' => ['nullable', 'string', function ($attribute, $value, $fail) use ($tahunTersedia) {
                if ($value === null || $value === '' || $value === 'all') {
                    return;
                }
                if (!ctype_digit((string) $value)) {
                    $fail('Tahun tidak valid.');
                    return;
                }
                if (!in_array((int) $value, $tahunTersedia, true)) {
                    $fail('Tahun yang dipilih tidak tersedia.');
                }
            }],
            'format' => 'required|in:xlsx,csv,pdf',
        ], [
            'format.required' => 'Format ekspor wajib dipilih',
            'format.in' => 'Format ekspor harus Excel, CSV, atau PDF',
        ]);

        $tahunParam = $request->input('tahun', 'all');
        $year = ($tahunParam === null || $tahunParam === '' || $tahunParam === 'all')
            ? null
            : (int) $tahunParam;
        $format = $request->input('format', 'xlsx');

        $headers = $this->statistikExportHeaders();
        $rows = $this->statistikExportRows($year);
        $meta = $this->statistikExportMeta($year);
        $filename = $this->statistikExportFilename($meta, $format);

        return match ($format) {
            'csv' => $this->statistikExportAsCsv($headers, $rows, $filename, $meta),
            'pdf' => $this->statistikExportAsPdf($headers, $rows, $filename, $meta),
            default => $this->statistikExportAsXlsx($headers, $rows, $filename, $meta),
        };
    }

    private function statistikExportMeta(?int $year): array
    {
        $query = HajiJamaah::whereNotNull('tahun_keberangkatan');
        if ($year !== null) {
            $query->where('tahun_keberangkatan', $year);
        }

        $minRaw = $query->min('tahun_keberangkatan');
        $maxRaw = $query->max('tahun_keberangkatan');
        $tahunMin = $minRaw !== null ? (int) $minRaw : null;
        $tahunMax = $maxRaw !== null ? (int) $maxRaw : null;

        if ($year !== null) {
            return [
                'judul' => 'Tahun ' . $year,
                'periode_label' => 'Tahun ' . $year,
                'periode_ringkas' => (string) $year,
                'tahun_min' => $year,
                'tahun_max' => $year,
                'semua_tahun' => false,
            ];
        }

        if ($tahunMin === null || $tahunMax === null) {
            return [
                'judul' => 'Semua Tahun',
                'periode_label' => 'Belum ada data dengan tahun keberangkatan',
                'periode_ringkas' => 'tanpa-tahun',
                'tahun_min' => null,
                'tahun_max' => null,
                'semua_tahun' => true,
            ];
        }

        $periodeLabel = $tahunMin === $tahunMax
            ? 'Tahun ' . $tahunMin
            : 'Tahun ' . $tahunMin . ' sampai ' . $tahunMax;

        return [
            'judul' => 'Semua Tahun',
            'periode_label' => $periodeLabel,
            'periode_ringkas' => $tahunMin === $tahunMax
                ? (string) $tahunMin
                : $tahunMin . '-' . $tahunMax,
            'tahun_min' => $tahunMin,
            'tahun_max' => $tahunMax,
            'semua_tahun' => true,
        ];
    }

    private function statistikExportHeaders(): array
    {
        return [
            'Nomor Porsi',
            'Nama Calon Haji',
            'Pendidikan',
            'KBIHU',
            'Alamat',
            'Kelurahan',
            'Kecamatan',
            'Usia',
            'Jenis Kelamin',
            'Tahun Keberangkatan',
        ];
    }

    private function statistikExportRows(?int $year): array
    {
        $query = HajiJamaah::orderByDesc('tahun_keberangkatan')->orderBy('nama');
        if ($year !== null) {
            $query->where('tahun_keberangkatan', $year);
        }

        return $query->get()
            ->map(function (HajiJamaah $row) {
                return [
                    (string) ($row->nomor_porsi ?? ''),
                    (string) ($row->nama ?? ''),
                    (string) ($row->pendidikan ?? ''),
                    (string) ($row->kbihu ?? ''),
                    (string) ($row->alamat ?? ''),
                    (string) ($row->kelurahan ?? ''),
                    (string) ($row->kecamatan ?? ''),
                    $row->usia !== null ? (int) $row->usia : '',
                    (string) ($row->jenis_kelamin ?? ''),
                    $row->tahun_keberangkatan !== null ? (int) $row->tahun_keberangkatan : '',
                ];
            })
            ->toArray();
    }

    private function statistikExportFilename(array $meta, string $format): string
    {
        $ext = match ($format) {
            'csv' => 'csv',
            'pdf' => 'pdf',
            default => 'xlsx',
        };

        return 'statistik-haji-' . $meta['periode_ringkas'] . '.' . $ext;
    }

    private function statistikExportPreambleRows(array $meta, int $total): array
    {
        return [
            ['Data Statistik Haji — Kementerian Haji dan Umrah Kota Cirebon'],
            ['Periode: ' . $meta['periode_label']],
            ['Total data: ' . number_format($total) . ' baris · Diekspor: ' . now()->format('d M Y, H:i')],
            [],
        ];
    }

    private function statistikExportApplySheetMeta($sheet, array $meta, int $total, int $colCount): int
    {
        $preamble = $this->statistikExportPreambleRows($meta, $total);
        $sheet->fromArray($preamble, null, 'A1');
        $lastCol = chr(ord('A') + max(0, $colCount - 1));

        foreach ([1, 2, 3] as $row) {
            $sheet->mergeCells("A{$row}:{$lastCol}{$row}");
        }

        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('16213E');
        $sheet->getStyle('A1')->getFont()->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        $sheet->getStyle('A2')->getFont()->setBold(true)->setSize(11);
        $sheet->getStyle('A2')->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('ECB176');

        $sheet->getStyle('A3')->getFont()->setSize(10);
        $sheet->getStyle('A3')->getFont()->getColor()->setRGB('4B5563');

        return count($preamble) + 1;
    }

    private function statistikExportAsXlsx(array $headers, array $rows, string $filename, array $meta): StreamedResponse
    {
        return response()->streamDownload(function () use ($headers, $rows, $meta) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Statistik Haji');

            $headerRow = $this->statistikExportApplySheetMeta($sheet, $meta, count($rows), count($headers));
            $sheet->fromArray($headers, null, 'A' . $headerRow);
            $sheet->getStyle('A' . $headerRow . ':' . chr(ord('A') + count($headers) - 1) . $headerRow)
                ->getFont()->setBold(true);
            $sheet->getStyle('A' . $headerRow . ':' . chr(ord('A') + count($headers) - 1) . $headerRow)
                ->getFill()
                ->setFillType(Fill::FILL_SOLID)
                ->getStartColor()->setRGB('F3F4F6');
            $sheet->getStyle('A')->getNumberFormat()->setFormatCode('@');

            if (!empty($rows)) {
                $sheet->fromArray($rows, null, 'A' . ($headerRow + 1));
            }

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    private function statistikExportAsCsv(array $headers, array $rows, string $filename, array $meta): StreamedResponse
    {
        return response()->streamDownload(function () use ($headers, $rows, $meta) {
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $headerRow = $this->statistikExportApplySheetMeta($sheet, $meta, count($rows), count($headers));
            $sheet->fromArray($headers, null, 'A' . $headerRow);
            $sheet->getStyle('A')->getNumberFormat()->setFormatCode('@');

            if (!empty($rows)) {
                $sheet->fromArray($rows, null, 'A' . ($headerRow + 1));
            }

            $writer = new Csv($spreadsheet);
            $writer->setDelimiter(',');
            $writer->setEnclosure('"');
            $writer->setUseBOM(true);
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    private function statistikExportAsPdf(array $headers, array $rows, string $filename, array $meta)
    {
        $html = view('admin.data-informasi.statistik.export-pdf', [
            'headers' => $headers,
            'rows' => $rows,
            'meta' => $meta,
            'exportedAt' => now()->format('d M Y, H:i'),
            'total' => count($rows),
        ])->render();

        $options = new Options();
        $options->set('isRemoteEnabled', false);
        $options->set('defaultFont', 'DejaVu Sans');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return response($dompdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    private function normalizeImportNomorPorsi(mixed $raw): ?string
    {
        if ($raw === null) {
            return null;
        }

        $text = trim((string) $raw);
        if ($text === '') {
            return null;
        }

        if (is_numeric($text)) {
            $digits = preg_replace('/\D+/', '', sprintf('%.0f', (float) $text));
        } else {
            $digits = preg_replace('/\D+/', '', $text);
        }

        if ($digits === '' || strlen($digits) < 6) {
            return null;
        }

        return $digits;
    }
}
