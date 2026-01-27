@extends('admin.layout')

@section('title', 'Daftar Berhak Lunas')
@section('page-title', 'Daftar Berhak Lunas')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: flex-end; align-items: center; gap: 12px; margin-bottom: 24px;">
        <button type="button" onclick="openBerhakLunasModal('import')" 
                style="padding: 10px 20px; background-color: #f3f4f6; color: #374151; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; border: 1px solid #e5e7eb; cursor: pointer;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 12v7m0 0l3-3m-3 3l-3-3M8 7h8a2 2 0 012 2v3H6V9a2 2 0 012-2z"/>
            </svg>
            Import Excel
        </button>
        <button type="button" onclick="openBerhakLunasModal('create')" 
                style="padding: 10px 20px; background-color: #ECB176; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; border: none; cursor: pointer;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Data
        </button>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: '{{ session('error') }}',
                    timer: 4000,
                    timerProgressBar: true,
                    showConfirmButton: true,
                    toast: true,
                    position: 'top-end'
                });
            });
        </script>
    @endif

    @if ($data->count() > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">No</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Nomor Porsi</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Nama</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Keterangan</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">KBIHU</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">No Paspor</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Nama Ayah</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Status</th>
                        <th style="padding: 12px; text-align: center; font-weight: 600; color: #374151;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $item)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px; color: #374151;">{{ $index + 1 }}</td>
                            <td style="padding: 12px; color: #6b7280;">{{ $item->nomor_porsi }}</td>
                            <td style="padding: 12px; color: #374151;">
                                <div style="font-weight: 600;">{{ $item->nama }}</div>
                            </td>
                            <td style="padding: 12px; color: #6b7280;">{{ $item->keterangan ?? '-' }}</td>
                            <td style="padding: 12px; color: #6b7280;">{{ $item->kbihu ?? '-' }}</td>
                            <td style="padding: 12px; color: #6b7280;">{{ $item->nomor_paspor ?? '-' }}</td>
                            <td style="padding: 12px; color: #6b7280;">{{ $item->nama_ayah ?? '-' }}</td>
                            <td style="padding: 12px;">
                                <span style="padding: 4px 12px; background-color: #F9E6D0; color: #8B6914; border-radius: 12px; font-size: 12px; font-weight: 600; display: inline-block;">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <div style="display: flex; gap: 8px; justify-content: center;">
                                    <a href="{{ route('admin.data-informasi.berhak-lunas.edit', $item->id) }}" 
                                       style="padding: 6px 12px; background-color: #3b82f6; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600; text-decoration: none;">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.data-informasi.berhak-lunas.destroy', $item->id) }}" method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                style="padding: 6px 12px; background-color: #ef4444; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600;">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div style="text-align: center; padding: 48px; color: #6b7280;">
            <svg style="width: 64px; height: 64px; margin: 0 auto 16px; color: #d1d5db;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <p style="font-size: 16px; margin-bottom: 8px;">Belum ada data</p>
            <p style="font-size: 14px; color: #9ca3af;">Mulai dengan menambahkan data pertama Anda</p>
            <button type="button" onclick="openBerhakLunasModal('create')"
                    style="display: inline-block; margin-top: 16px; padding: 10px 20px; background-color: #ECB176; color: white; border-radius: 8px; text-decoration: none; font-weight: 600; border: none; cursor: pointer;">
                Tambah Data
            </button>
        </div>
    @endif
</div>

<!-- Modal Import Excel -->
<div id="berhakLunasImportModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.5); z-index: 9999; align-items: center; justify-content: center; padding: 24px;">
    <div style="background: #fff; width: 100%; max-width: 520px; border-radius: 16px; padding: 24px; position: relative; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.2);">
        <button type="button" onclick="closeBerhakLunasModal('import')" style="position: absolute; top: 14px; right: 14px; background: transparent; border: none; font-size: 18px; cursor: pointer;">✕</button>
        <h3 style="font-size: 18px; font-weight: 700; color: #1f2937; margin-bottom: 8px;">Import Data Berhak Lunas</h3>
        <p style="font-size: 13px; color: #6b7280; margin-bottom: 16px;">Unggah file .xls, .xlsx, atau .csv. Kolom yang didukung: Nomor Porsi, Nama, Keterangan, KBIHU, No Paspor, Nama Ayah, Status. File hanya dipakai untuk import dan tidak disimpan.</p>
        <form method="POST" action="{{ route('admin.data-informasi.berhak-lunas.import') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" accept=".xlsx,.xls,.csv" required
                   style="width: 100%; padding: 12px; border: 1px dashed #cbd5f5; border-radius: 10px; background: #f8fafc; margin-bottom: 16px;">
            <div style="display: flex; justify-content: flex-end; gap: 8px;">
                <button type="button" onclick="closeBerhakLunasModal('import')" style="padding: 8px 14px; border: 1px solid #d1d5db; border-radius: 8px; background: #fff; cursor: pointer;">Batal</button>
                <button type="submit" style="padding: 8px 14px; border: 1px solid #e5e7eb; border-radius: 8px; background: #f3f4f6; color: #374151; font-weight: 600; cursor: pointer;">Import</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Tambah Data -->
<div id="berhakLunasCreateModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.5); z-index: 9999; align-items: center; justify-content: center; padding: 24px;">
    <div style="background: #fff; width: 100%; max-width: 560px; border-radius: 16px; padding: 24px; position: relative; box-shadow: 0 20px 40px rgba(15, 23, 42, 0.2);">
        <button type="button" onclick="closeBerhakLunasModal('create')" style="position: absolute; top: 14px; right: 14px; background: transparent; border: none; font-size: 18px; cursor: pointer;">✕</button>
        <h3 style="font-size: 18px; font-weight: 700; color: #1f2937; margin-bottom: 8px;">Tambah Data Berhak Lunas</h3>
        <form method="POST" action="{{ route('admin.data-informasi.berhak-lunas.store') }}">
            @csrf
            <div style="display: grid; gap: 12px;">
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">Nomor Porsi</label>
                    <input type="text" name="nomor_porsi" required
                           style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">Nama</label>
                    <input type="text" name="nama" required
                           style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">Keterangan</label>
                    <select name="keterangan"
                            style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; background: #fff;">
                        <option value="">-- Pilih --</option>
                        <option value="Siap Berangkat">Siap Berangkat</option>
                        <option value="Meninggal">Meninggal</option>
                        <option value="Tunda Berangkat">Tunda Berangkat</option>
                        <option value="Tersambung">Tersambung</option>
                        <option value="Gak Nyambung">Gak Nyambung</option>
                    </select>
                </div>
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">KBIHU</label>
                    <input type="text" name="kbihu"
                           style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">No Paspor</label>
                    <input type="text" name="nomor_paspor"
                           style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">Nama Ayah</label>
                    <input type="text" name="nama_ayah"
                           style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">Status</label>
                    <select name="status" required style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; background: #fff;">
                        <option value="Cadangan">Cadangan</option>
                        <option value="Bukan Cadangan">Bukan Cadangan</option>
                    </select>
                </div>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 8px; margin-top: 16px;">
                <button type="button" onclick="closeBerhakLunasModal('create')" style="padding: 8px 14px; border: 1px solid #d1d5db; border-radius: 8px; background: #fff; cursor: pointer;">Batal</button>
                <button type="submit" style="padding: 8px 14px; border: none; border-radius: 8px; background: #ECB176; color: #fff; font-weight: 600; cursor: pointer;">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openBerhakLunasModal(type) {
        if (type === 'import') {
            document.getElementById('berhakLunasImportModal').style.display = 'flex';
        } else {
            document.getElementById('berhakLunasCreateModal').style.display = 'flex';
        }
    }
    function closeBerhakLunasModal(type) {
        if (type === 'import') {
            document.getElementById('berhakLunasImportModal').style.display = 'none';
        } else {
            document.getElementById('berhakLunasCreateModal').style.display = 'none';
        }
    }
</script>
@endsection
