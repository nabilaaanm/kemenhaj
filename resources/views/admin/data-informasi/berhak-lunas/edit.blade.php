@extends('admin.layout')

@section('title', 'Edit Berhak Lunas')
@section('page-title', 'Edit Berhak Lunas')

@section('content')
<div class="card">
    <div style="margin-bottom: 24px;">
        <a href="{{ route('admin.data-informasi.berhak-lunas.index') }}" style="display: inline-flex; align-items: center; color: #6b7280; text-decoration: none; margin-bottom: 16px;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar Berhak Lunas
        </a>
    </div>

    <h3 style="margin-bottom: 24px;">Edit Data Berhak Lunas</h3>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
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

    <form action="{{ route('admin.data-informasi.berhak-lunas.update', $data->id) }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Nomor Porsi <span style="color: #ef4444;">*</span></label>
            <input type="text" name="nomor_porsi" value="{{ old('nomor_porsi', $data->nomor_porsi) }}" required minlength="10" maxlength="10" pattern="\d{10}"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="123456789">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Nama <span style="color: #ef4444;">*</span></label>
            <input type="text" name="nama" value="{{ old('nama', $data->nama) }}" required
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="Nama jamaah">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Nama Ayah</label>
            <input type="text" name="nama_ayah" value="{{ old('nama_ayah', $data->nama_ayah) }}"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="Nama ayah">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Status <span style="color: #ef4444;">*</span></label>
            <select name="status" required
                    style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; background-color: white;">
                <option value="Cadangan" {{ old('status', $data->status) == 'Cadangan' ? 'selected' : '' }}>Cadangan</option>
                <option value="Bukan Cadangan" {{ old('status', $data->status) == 'Bukan Cadangan' ? 'selected' : '' }}>Bukan Cadangan</option>
            </select>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Keterangan</label>
            <input type="text" name="keterangan" value="{{ old('keterangan', $data->keterangan) }}"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="Keterangan">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Nomor Paspor</label>
            <input type="text" name="nomor_paspor" value="{{ old('nomor_paspor', $data->nomor_paspor) }}" minlength="8" maxlength="8" pattern="[A-Za-z0-9]{8}"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="Nomor paspor">
        </div>

        <div style="display: flex; gap: 12px; margin-top: 32px;">
            <button type="submit" 
                    style="flex: 1; padding: 12px 24px; background-color: #ECB176; color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer;">
                Perbarui Data
            </button>
            <a href="{{ route('admin.data-informasi.berhak-lunas.index') }}" 
               style="padding: 12px 24px; background-color: #e5e7eb; color: #374151; border: none; border-radius: 8px; font-weight: 600; font-size: 14px; text-decoration: none; display: inline-block; text-align: center;">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
