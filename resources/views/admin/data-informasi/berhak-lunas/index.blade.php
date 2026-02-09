@extends('admin.layout')

@section('title', 'Daftar Berhak Lunas')
@section('page-title', 'Daftar Berhak Lunas')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 24px; flex-wrap: wrap;">
        <form method="GET" action="{{ route('admin.data-informasi.berhak-lunas.index') }}" id="berhakLunasSearchForm" style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
            <div style="position: relative;">
                <input type="text" name="q" id="berhakLunasSearchInput" value="{{ $search ?? '' }}" placeholder="Cari nomor porsi, nama, paspor, ayah..."
                       style="min-width: 280px; padding: 10px 36px 10px 12px; border: 1px solid #e5e7eb; border-radius: 10px; font-size: 14px; background: #ffffff; box-shadow: 0 6px 16px rgba(15, 23, 42, 0.06);">
                <svg style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; color: #9ca3af;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <select name="status" id="berhakLunasStatusFilter"
                    style="padding: 10px 12px; border: 1px solid #e5e7eb; border-radius: 10px; font-size: 14px; background: #ffffff; box-shadow: 0 6px 16px rgba(15, 23, 42, 0.06);">
                <option value="">Semua Status</option>
                <option value="Cadangan" {{ ($statusFilter ?? '') === 'Cadangan' ? 'selected' : '' }}>Cadangan</option>
                <option value="Bukan Cadangan" {{ ($statusFilter ?? '') === 'Bukan Cadangan' ? 'selected' : '' }}>Bukan Cadangan</option>
            </select>
            @if(!empty($search) || !empty($statusFilter))
                <a href="{{ route('admin.data-informasi.berhak-lunas.index') }}"
                   style="padding: 10px 12px; border-radius: 10px; background: #f3f4f6; color: #374151; font-weight: 600; text-decoration: none;">
                    Reset
                </a>
            @endif
        </form>
        <div style="display: flex; justify-content: flex-end; align-items: center; gap: 12px; flex-wrap: wrap;">
            <form action="{{ route('admin.data-informasi.berhak-lunas.destroy-all') }}" method="POST" onsubmit="return confirm('Hapus semua data berhak lunas?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        style="padding: 10px 16px; background-color: #fee2e2; color: #991b1b; border-radius: 8px; border: 1px solid #fca5a5; font-weight: 600; cursor: pointer;">
                    Hapus Semua
                </button>
            </form>
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

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let errorMessages = '';
                @foreach($errors->all() as $error)
                    errorMessages += '<li style="margin-bottom: 8px;">{{ addslashes($error) }}</li>';
                @endforeach
                
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal!',
                    html: '<ul style="text-align: left; margin: 0; padding-left: 20px; list-style-type: disc;">' + errorMessages + '</ul>',
                    showConfirmButton: true,
                    confirmButtonColor: '#ECB176',
                    width: '600px'
                });
            });
        </script>
    @endif

    @if ($data->count() > 0)
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse;" id="berhakLunasTable">
                <thead>
                    <tr style="background-color: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">No</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Nomor Porsi</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Nama</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Keterangan</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">No Paspor</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Nama Ayah</th>
                        <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151;">Status</th>
                        <th style="padding: 12px; text-align: center; font-weight: 600; color: #374151;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $item)
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px; color: #374151;">{{ $data->firstItem() + $index }}</td>
                            <td style="padding: 12px; color: #6b7280;">{{ $item->nomor_porsi }}</td>
                            <td style="padding: 12px; color: #374151;">
                                <div style="font-weight: 600;">{{ $item->nama }}</div>
                            </td>
                            <td style="padding: 12px; color: #6b7280;">{{ $item->keterangan ?? '-' }}</td>
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
        <div style="margin-top: 16px;">
            {{ $data->onEachSide(1)->links('pagination.berhak-lunas') }}
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
        <p style="font-size: 13px; color: #6b7280; margin-bottom: 16px;">
            Unggah file .xls, .xlsx, atau .csv. Kolom yang didukung: Nomor Porsi, Nama, Keterangan, No Paspor, Nama Ayah, Status. File hanya dipakai untuk import dan tidak disimpan.
        </p>
        <a href="{{ route('admin.data-informasi.berhak-lunas.template') }}"
           style="display: inline-flex; align-items: center; gap: 8px; font-size: 12px; font-weight: 700; color: #7c2d12; text-decoration: none; margin-bottom: 16px; padding: 8px 12px; border-radius: 999px; background: #fff7ed; border: 1px solid #fed7aa; box-shadow: 0 6px 14px rgba(15, 23, 42, 0.08); transition: transform 0.2s ease, box-shadow 0.2s ease;">
            <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 12v7m0 0l3-3m-3 3l-3-3M8 7h8a2 2 0 012 2v3H6V9a2 2 0 012-2z"/>
            </svg>
            Download Template Excel
        </a>
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
        <form method="POST" action="{{ route('admin.data-informasi.berhak-lunas.store') }}" id="berhakLunasCreateForm">
            @csrf
            <div style="display: grid; gap: 12px;">
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">Nomor Porsi</label>
                    <input type="text" name="nomor_porsi" id="berhakLunasNomorPorsi" required minlength="10" maxlength="10" pattern="\d{10}"
                           style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">Nama</label>
                    <input type="text" name="nama" required
                           style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">Keterangan</label>
                    <input type="text" name="keterangan"
                           style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;">
                </div>
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">No Paspor</label>
                    <input type="text" name="nomor_paspor" id="berhakLunasNomorPaspor" minlength="8" maxlength="8" pattern="[A-Za-z0-9]{8}"
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

    document.addEventListener('DOMContentLoaded', function () {
        const createForm = document.getElementById('berhakLunasCreateForm');
        const nomorPorsiInput = document.getElementById('berhakLunasNomorPorsi');
        const nomorPasporInput = document.getElementById('berhakLunasNomorPaspor');
        const input = document.getElementById('berhakLunasSearchInput');
        const form = document.getElementById('berhakLunasSearchForm');
        const table = document.getElementById('berhakLunasTable');
        const rows = table ? Array.from(table.querySelectorAll('tbody tr')) : [];
        let debounceTimer;

        const showValidationError = (message) => {
            Swal.fire({
                icon: 'error',
                title: 'Validasi Gagal',
                text: message,
                confirmButtonColor: '#ECB176'
            });
        };

        if (createForm) {
            createForm.addEventListener('submit', function (event) {
                const nomorPorsi = (nomorPorsiInput?.value || '').trim();
                const nomorPaspor = (nomorPasporInput?.value || '').trim();

                if (!/^\d{10}$/.test(nomorPorsi)) {
                    event.preventDefault();
                    showValidationError('Nomor porsi harus 10 digit angka.');
                    return;
                }

                if (nomorPaspor !== '' && !/^[A-Za-z0-9]{8}$/.test(nomorPaspor)) {
                    event.preventDefault();
                    showValidationError('Nomor paspor harus 8 karakter huruf/angka.');
                }
            });
        }

        const filterRows = () => {
            const query = (input?.value || '').toLowerCase().trim();
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        };

        if (input && form) {
            input.addEventListener('input', function () {
                filterRows();
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    form.submit();
                }, 500);
            });
        }
        const statusFilter = document.getElementById('berhakLunasStatusFilter');
        if (statusFilter && form) {
            statusFilter.addEventListener('change', function () {
                form.submit();
            });
        }
    });
</script>
@endsection
