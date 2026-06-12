@extends('admin.layout')

@section('title', 'LK & PIH')
@section('page-title', 'LK & PIH')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: flex-end; align-items: center; gap: 10px; margin-bottom: 24px;">
        <button type="button" id="lkImportButton"
                style="padding: 10px 20px; background-color: #f3f4f6; color: #374151; border-radius: 8px; border: 1px solid #e5e7eb; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; cursor: pointer;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 12v7m0 0l3-3m-3 3l-3-3M8 7h8a2 2 0 012 2v3H6V9a2 2 0 012-2z"/>
            </svg>
            Tambah LK
        </button>
        <button type="button" id="pihImportButton"
                style="padding: 10px 20px; background-color: #f3f4f6; color: #374151; border-radius: 8px; border: 1px solid #e5e7eb; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; cursor: pointer;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 12v7m0 0l3-3m-3 3l-3-3M8 7h8a2 2 0 012 2v3H6V9a2 2 0 012-2z"/>
            </svg>
            Tambah PIH
        </button>
    </div>

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
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                    timer: 4000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
            });
        </script>
    @endif

    <div style="display: grid; gap: 24px;">
        <div style="background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 20px;">
            <h3 style="margin-bottom: 16px;">Laporan Keuangan (LK)</h3>
            @if ($lkDocuments->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; table-layout: auto;">
                        <thead>
                            <tr style="background-color: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151; min-width: 300px;">Judul</th>
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151; white-space: nowrap;">Tanggal</th>
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151; white-space: nowrap;">File</th>
                                <th style="padding: 12px; text-align: center; font-weight: 600; color: #374151; white-space: nowrap;">Urutan</th>
                                <th style="padding: 12px; text-align: center; font-weight: 600; color: #374151; white-space: nowrap;">Status</th>
                                <th style="padding: 12px; text-align: center; font-weight: 600; color: #374151; white-space: nowrap;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lkDocuments as $doc)
                                <tr style="border-bottom: 1px solid #e5e7eb;">
                                    <td style="padding: 12px; color: #374151; max-width: 420px; word-wrap: break-word;">
                                        <div style="font-weight: 600; margin-bottom: 4px; line-height: 1.5;">{{ $doc->title }}</div>
                                        @if($doc->description)
                                            <div style="font-size: 12px; color: #6b7280; margin-top: 4px; line-height: 1.4;">{{ Str::limit($doc->description, 100) }}</div>
                                        @endif
                                    </td>
                                    <td style="padding: 12px; color: #6b7280; font-size: 14px; white-space: nowrap;">
                                        {{ $doc->document_date?->format('d/m/Y') }}
                                    </td>
                                    <td style="padding: 12px; white-space: nowrap;">
                                        @if($doc->file_url)
                                            <a href="{{ $doc->file_url }}" target="_blank" style="color: #ECB176; text-decoration: none; font-size: 12px; display: inline-flex; align-items: center; gap: 4px;">
                                                <svg style="width: 16px; height: 16px; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                </svg>
                                                <span>Lihat PDF</span>
                                            </a>
                                        @else
                                            <span style="color: #9ca3af; font-size: 12px;">Tidak ada file</span>
                                        @endif
                                    </td>
                                    <td style="padding: 12px; color: #6b7280; font-size: 14px; text-align: center;">
                                        {{ $doc->order }}
                                    </td>
                                    <td style="padding: 12px; text-align: center;">
                                        <span style="padding: 4px 12px; background-color: {{ $doc->is_active ? '#d1fae5' : '#fee2e2' }}; color: {{ $doc->is_active ? '#065f46' : '#991b1b' }}; border-radius: 12px; font-size: 12px; font-weight: 600; display: inline-block;">
                                            {{ $doc->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td style="padding: 12px; text-align: center;">
                                        <form action="{{ route('admin.lk-pih.destroy', $doc->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    style="padding: 6px 12px; background-color: #ef4444; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600;"
                                                    onclick="event.preventDefault(); Swal.fire({
                                                        title: 'Apakah Anda yakin?',
                                                        text: 'Dokumen ini akan dihapus secara permanen!',
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#ECB176',
                                                        cancelButtonColor: '#6b7280',
                                                        confirmButtonText: 'Ya, Hapus!',
                                                        cancelButtonText: 'Batal'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            this.closest('form').submit();
                                                        }
                                                    });">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($lkDocuments->hasPages())
                    <div style="margin-top: 16px;">
                        {{ $lkDocuments->onEachSide(1)->links('pagination.berhak-lunas') }}
                    </div>
                @endif
            @else
                <div style="text-align: center; padding: 32px; color: #6b7280;">
                    <p style="font-size: 14px;">Belum ada dokumen LK</p>
                </div>
            @endif
        </div>

        <div style="background: #fff; border: 1px solid #e5e7eb; border-radius: 12px; padding: 20px;">
            <h3 style="margin-bottom: 16px;">Penyelenggaraan Ibadah Haji (PIH)</h3>
            @if ($pihDocuments->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; table-layout: auto;">
                        <thead>
                            <tr style="background-color: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151; min-width: 300px;">Judul</th>
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151; white-space: nowrap;">Tanggal</th>
                                <th style="padding: 12px; text-align: left; font-weight: 600; color: #374151; white-space: nowrap;">File</th>
                                <th style="padding: 12px; text-align: center; font-weight: 600; color: #374151; white-space: nowrap;">Urutan</th>
                                <th style="padding: 12px; text-align: center; font-weight: 600; color: #374151; white-space: nowrap;">Status</th>
                                <th style="padding: 12px; text-align: center; font-weight: 600; color: #374151; white-space: nowrap;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pihDocuments as $doc)
                                <tr style="border-bottom: 1px solid #e5e7eb;">
                                    <td style="padding: 12px; color: #374151; max-width: 420px; word-wrap: break-word;">
                                        <div style="font-weight: 600; margin-bottom: 4px; line-height: 1.5;">{{ $doc->title }}</div>
                                        @if($doc->description)
                                            <div style="font-size: 12px; color: #6b7280; margin-top: 4px; line-height: 1.4;">{{ Str::limit($doc->description, 100) }}</div>
                                        @endif
                                    </td>
                                    <td style="padding: 12px; color: #6b7280; font-size: 14px; white-space: nowrap;">
                                        {{ $doc->document_date?->format('d/m/Y') }}
                                    </td>
                                    <td style="padding: 12px; white-space: nowrap;">
                                        @if($doc->file_url)
                                            <a href="{{ $doc->file_url }}" target="_blank" style="color: #ECB176; text-decoration: none; font-size: 12px; display: inline-flex; align-items: center; gap: 4px;">
                                                <svg style="width: 16px; height: 16px; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                                </svg>
                                                <span>Lihat PDF</span>
                                            </a>
                                        @else
                                            <span style="color: #9ca3af; font-size: 12px;">Tidak ada file</span>
                                        @endif
                                    </td>
                                    <td style="padding: 12px; color: #6b7280; font-size: 14px; text-align: center;">
                                        {{ $doc->order }}
                                    </td>
                                    <td style="padding: 12px; text-align: center;">
                                        <span style="padding: 4px 12px; background-color: {{ $doc->is_active ? '#d1fae5' : '#fee2e2' }}; color: {{ $doc->is_active ? '#065f46' : '#991b1b' }}; border-radius: 12px; font-size: 12px; font-weight: 600; display: inline-block;">
                                            {{ $doc->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td style="padding: 12px; text-align: center;">
                                        <form action="{{ route('admin.lk-pih.destroy', $doc->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    style="padding: 6px 12px; background-color: #ef4444; color: white; border: none; border-radius: 6px; cursor: pointer; font-size: 12px; font-weight: 600;"
                                                    onclick="event.preventDefault(); Swal.fire({
                                                        title: 'Apakah Anda yakin?',
                                                        text: 'Dokumen ini akan dihapus secara permanen!',
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#ECB176',
                                                        cancelButtonColor: '#6b7280',
                                                        confirmButtonText: 'Ya, Hapus!',
                                                        cancelButtonText: 'Batal'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            this.closest('form').submit();
                                                        }
                                                    });">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @if($pihDocuments->hasPages())
                    <div style="margin-top: 16px;">
                        {{ $pihDocuments->onEachSide(1)->links('pagination.berhak-lunas') }}
                    </div>
                @endif
            @else
                <div style="text-align: center; padding: 32px; color: #6b7280;">
                    <p style="font-size: 14px;">Belum ada dokumen PIH</p>
                </div>
            @endif
        </div>
    </div>
</div>

<div id="lkImportModal" style="position: fixed; inset: 0; background: rgba(15, 23, 42, 0.45); display: none; align-items: center; justify-content: center; padding: 16px; z-index: 60;">
    <div style="background: white; width: 100%; max-width: 560px; border-radius: 14px; padding: 20px; box-shadow: 0 20px 50px rgba(15, 23, 42, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h3 style="margin: 0; font-size: 18px; font-weight: 700; color: #111827;">Import LK (PDF)</h3>
            <button type="button" id="lkImportClose" style="border: none; background: transparent; font-size: 20px; cursor: pointer; color: #6b7280;">&times;</button>
        </div>
        <form action="{{ route('admin.lk-pih.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="type" value="lk">
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #374151;">Judul Dokumen</label>
                <input type="text" name="title" required
                       style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;">
            </div>
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #374151;">Deskripsi (opsional)</label>
                <textarea name="description" rows="3"
                          style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;"></textarea>
            </div>
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #374151;">Tanggal Dokumen</label>
                <input type="date" name="document_date" required
                       style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;">
            </div>
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #374151;">File PDF</label>
                <p style="color: #6b7280; font-size: 12px; margin-bottom: 8px;">
                    Format: PDF (Maksimal 10MB). Batas server: upload_max_filesize {{ ini_get('upload_max_filesize') }}, post_max_size {{ ini_get('post_max_size') }}.
                </p>
                <input type="file" name="file" accept="application/pdf" required
                       style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; background: #fff;">
            </div>
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #374151;">Urutan</label>
                <input type="number" name="order" min="0" value="0"
                       style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;">
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 18px;">
                <button type="button" id="lkImportCancel"
                        style="padding: 10px 16px; border: 1px solid #e5e7eb; background: #f9fafb; border-radius: 8px; cursor: pointer;">
                    Batal
                </button>
                <button type="submit"
                        style="padding: 10px 18px; background: #ECB176; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">
                    Upload LK
                </button>
            </div>
        </form>
    </div>
</div>

<div id="pihImportModal" style="position: fixed; inset: 0; background: rgba(15, 23, 42, 0.45); display: none; align-items: center; justify-content: center; padding: 16px; z-index: 60;">
    <div style="background: white; width: 100%; max-width: 560px; border-radius: 14px; padding: 20px; box-shadow: 0 20px 50px rgba(15, 23, 42, 0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h3 style="margin: 0; font-size: 18px; font-weight: 700; color: #111827;">Import PIH (PDF)</h3>
            <button type="button" id="pihImportClose" style="border: none; background: transparent; font-size: 20px; cursor: pointer; color: #6b7280;">&times;</button>
        </div>
        <form action="{{ route('admin.lk-pih.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="type" value="pih">
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #374151;">Judul Dokumen</label>
                <input type="text" name="title" required
                       style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;">
            </div>
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #374151;">Deskripsi (opsional)</label>
                <textarea name="description" rows="3"
                          style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;"></textarea>
            </div>
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #374151;">Tanggal Dokumen</label>
                <input type="date" name="document_date" required
                       style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;">
            </div>
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #374151;">File PDF</label>
                <p style="color: #6b7280; font-size: 12px; margin-bottom: 8px;">
                    Format: PDF (Maksimal 10MB). Batas server: upload_max_filesize {{ ini_get('upload_max_filesize') }}, post_max_size {{ ini_get('post_max_size') }}.
                </p>
                <input type="file" name="file" accept="application/pdf" required
                       style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; background: #fff;">
            </div>
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-weight: 600; margin-bottom: 6px; color: #374151;">Urutan</label>
                <input type="number" name="order" min="0" value="0"
                       style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px;">
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 18px;">
                <button type="button" id="pihImportCancel"
                        style="padding: 10px 16px; border: 1px solid #e5e7eb; background: #f9fafb; border-radius: 8px; cursor: pointer;">
                    Batal
                </button>
                <button type="submit"
                        style="padding: 10px 18px; background: #ECB176; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">
                    Upload PIH
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lkOpenBtn = document.getElementById('lkImportButton');
        const lkModal = document.getElementById('lkImportModal');
        const lkCloseBtn = document.getElementById('lkImportClose');
        const lkCancelBtn = document.getElementById('lkImportCancel');

        const pihOpenBtn = document.getElementById('pihImportButton');
        const pihModal = document.getElementById('pihImportModal');
        const pihCloseBtn = document.getElementById('pihImportClose');
        const pihCancelBtn = document.getElementById('pihImportCancel');

        const closeModal = (modal) => {
            modal.style.display = 'none';
        };

        lkOpenBtn?.addEventListener('click', () => {
            lkModal.style.display = 'flex';
        });
        lkCloseBtn?.addEventListener('click', () => closeModal(lkModal));
        lkCancelBtn?.addEventListener('click', () => closeModal(lkModal));
        lkModal?.addEventListener('click', (event) => {
            if (event.target === lkModal) {
                closeModal(lkModal);
            }
        });

        pihOpenBtn?.addEventListener('click', () => {
            pihModal.style.display = 'flex';
        });
        pihCloseBtn?.addEventListener('click', () => closeModal(pihModal));
        pihCancelBtn?.addEventListener('click', () => closeModal(pihModal));
        pihModal?.addEventListener('click', (event) => {
            if (event.target === pihModal) {
                closeModal(pihModal);
            }
        });
    });
</script>
@endsection
