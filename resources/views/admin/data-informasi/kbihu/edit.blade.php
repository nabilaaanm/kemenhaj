@extends('admin.layout')

@section('title', 'Edit KBIHU')
@section('page-title', 'Edit KBIHU')

@section('content')
<div class="card">
    <div style="margin-bottom: 24px;">
        <a href="{{ route('admin.data-informasi.kbihu.index') }}" style="display: inline-flex; align-items: center; color: #6b7280; text-decoration: none; margin-bottom: 16px;">
            <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Daftar KBIHU
        </a>
    </div>

    <h3 style="margin-bottom: 24px;">Edit Data KBIHU</h3>

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

    <form action="{{ route('admin.data-informasi.kbihu.update', $data->id) }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Nama KBIHU <span style="color: #ef4444;">*</span></label>
            <input type="text" name="nama" value="{{ old('nama', $data->nama) }}" required
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="KBIHU Kota Cirebon">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Alamat <span style="color: #ef4444;">*</span></label>
            <textarea name="alamat" rows="3" required
                      style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; resize: vertical;"
                      placeholder="Jl. Terusan Pemuda, Sunyaragi, Kec. Kesambi, Kota Cirebon, Jawa Barat 45132">{{ old('alamat', $data->alamat) }}</textarea>
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Tahun Berdiri</label>
            <input type="text" name="tahun_berdiri" value="{{ old('tahun_berdiri', $data->tahun_berdiri) }}"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="Contoh: 2014">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Nama Pimpinan</label>
            <input type="text" name="nama_pimpinan" value="{{ old('nama_pimpinan', $data->nama_pimpinan) }}"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="Nama pimpinan">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Telepon</label>
            <input type="text" name="telp" value="{{ old('telp', $data->telp) }}"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="(0231) 486047">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Latitude</label>
            <input type="text" name="latitude" value="{{ old('latitude', $data->latitude) }}"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="-6.744815529">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Longitude</label>
            <input type="text" name="longitude" value="{{ old('longitude', $data->longitude) }}"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="108.5404318">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Link Google Maps</label>
            <input type="text" name="maps_url" value="{{ old('maps_url', $data->maps_url) }}"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="https://maps.google.com/?q=...">
        </div>

        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Urutan</label>
            <input type="number" name="order" value="{{ old('order', $data->order) }}" min="0"
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                   placeholder="0">
        </div>

        <div style="display: flex; gap: 12px; margin-top: 32px;">
            <button type="submit" 
                    style="flex: 1; padding: 12px 24px; background-color: #ECB176; color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer;">
                Perbarui Data
            </button>
            <a href="{{ route('admin.data-informasi.kbihu.index') }}" 
               style="padding: 12px 24px; background-color: #e5e7eb; color: #374151; border: none; border-radius: 8px; font-weight: 600; font-size: 14px; text-decoration: none; display: inline-block; text-align: center;">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
