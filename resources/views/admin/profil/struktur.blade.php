@extends('admin.layout')

@section('title', 'Profil - Struktur & Tim')
@section('page-title', 'Profil - Struktur & Tim')

@section('content')
<div class="card">
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

    <!-- Struktur Organisasi -->
    <form method="POST" action="{{ route('admin.profil.struktur.update') }}" enctype="multipart/form-data" style="margin-bottom: 32px;">
        @csrf
        <input type="hidden" name="redirect_to" value="admin.profil.struktur">

        <div style="margin-bottom: 24px;">
            <h3 style="font-size: 18px; font-weight: 700; color: #1f2937; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 2px solid #e5e7eb;">Struktur Organisasi</h3>
            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Subjudul</label>
                <input 
                    type="text" 
                    name="struktur_subjudul" 
                    value="{{ old('struktur_subjudul', $profil->struktur_subjudul ?? '') }}" 
                    class="form-input" 
                    style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                    placeholder="Subjudul untuk halaman struktur organisasi"
                >
                @error('struktur_subjudul')
                    <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
            </div>
            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Gambar Struktur Organisasi</label>
                @if(!empty($profil?->struktur_gambar_url))
                    <div style="margin-bottom: 12px;">
                        <img src="{{ $profil->struktur_gambar_url }}" alt="Struktur Organisasi" style="max-width: 100%; height: auto; border-radius: 8px; border: 1px solid #d1d5db;">
                    </div>
                @endif
                <input 
                    type="file" 
                    name="struktur_gambar" 
                    accept="image/*"
                    style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;"
                >
                <p style="font-size: 12px; color: #6b7280; margin-top: 4px;">Format: JPG, PNG, maksimal 2MB</p>
                @error('struktur_gambar')
                    <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <button type="submit" style="padding: 12px 24px; background-color: #ECB176; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; transition: background-color 0.2s;">
            Simpan Perubahan Struktur
        </button>
    </form>

    <!-- Tim Kemenhaj -->
    <div style="margin-bottom: 32px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 2px solid #e5e7eb;">
                <h3 style="font-size: 18px; font-weight: 700; color: #1f2937; margin: 0;">Tim Kemenhaj</h3>
                <button type="button" onclick="openTimModal()" style="padding: 8px 16px; background-color: #ECB176; color: white; border: none; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer;">
                    + Tambah Anggota
                </button>
            </div>

            @if($tim && $tim->count() > 0)
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 20px;">
                    @foreach($tim as $member)
                        <div style="background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 12px; padding: 16px; text-align: center;">
                            <div style="position: relative; margin-bottom: 12px;">
                                <img src="{{ $member->foto_url }}" alt="{{ $member->nama }}" 
                                     style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%; border: 3px solid #ECB176; margin: 0 auto; display: block;">
                            </div>
                            <h4 style="font-size: 16px; font-weight: 700; color: #1f2937; margin-bottom: 4px;">{{ $member->nama }}</h4>
                            <p style="font-size: 13px; color: #6b7280; margin-bottom: 12px;">{{ $member->jabatan }}</p>
                            <div style="display: flex; gap: 8px; justify-content: center;">
                                <button type="button" onclick="editTim({{ $member->id }})" style="padding: 6px 12px; background-color: #3b82f6; color: white; border: none; border-radius: 6px; font-size: 12px; cursor: pointer;">
                                    Edit
                                </button>
                                <form action="{{ route('admin.profil.tim.destroy', $member->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="padding: 6px 12px; background-color: #ef4444; color: white; border: none; border-radius: 6px; font-size: 12px; cursor: pointer;">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 40px; background: #f9fafb; border: 2px dashed #d1d5db; border-radius: 12px;">
                    <p style="color: #6b7280; margin-bottom: 16px;">Belum ada anggota tim</p>
                    <button type="button" onclick="openTimModal()" style="padding: 10px 20px; background-color: #ECB176; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;">
                        Tambah Anggota Pertama
                    </button>
                </div>
            @endif
    </div>
</div>

@include('admin.profil.tim-modal')
@endsection
