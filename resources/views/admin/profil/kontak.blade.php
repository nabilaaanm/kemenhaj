@extends('admin.layout')

@section('title', 'Profil - Kontak')
@section('page-title', 'Profil - Kontak')

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
    @if($errors->any())
        <div style="background-color: #fee2e2; color: #991b1b; padding: 12px; border-radius: 8px; margin-bottom: 24px;">
            <div style="font-weight: 600; margin-bottom: 6px;">Periksa kembali data yang Anda isi:</div>
            <ul style="padding-left: 18px; list-style: disc;">
                @foreach($errors->all() as $error)
                    <li style="font-size: 12px;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.profil.kontak.update') }}" style="max-width: 1100px; margin: 0 auto;">
        @csrf
        <input type="hidden" name="redirect_to" value="admin.profil.kontak">

        <!-- Title Section -->
        <div style="margin-bottom: 32px; text-align: center;">
            <h1 style="font-size: 24px; font-weight: 700; color: #374151; margin-bottom: 8px;">
                Kontak Kami
            </h1>
            <p style="font-size: 14px; color: #6b7280;">
                Hubungi kami untuk informasi lebih lanjut tentang layanan Kementerian Haji dan Umrah Kota Cirebon
            </p>
        </div>

        <!-- Contact Information Grid -->
        <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 20px; margin-bottom: 24px;">
            <!-- Address Card -->
            <div style="background: #ffffff; border-radius: 16px; padding: 20px; box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <div style="width: 40px; height: 40px; border-radius: 999px; display: flex; align-items: center; justify-content: center; background-color: #ECB176;">
                        <svg style="width: 20px; height: 20px; color: #fff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 16px; font-weight: 700; color: #374151;">Alamat</h3>
                </div>
                <div style="display: grid; gap: 12px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">Alamat</label>
                        <input 
                            type="text" 
                            name="alamat" 
                            value="{{ old('alamat', $profil->alamat ?? '') }}" 
                            style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 10px; font-size: 14px;"
                            placeholder="Masukkan alamat lengkap"
                        >
                        @error('alamat')
                            <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">Keterangan Alamat</label>
                        <input 
                            type="text" 
                            name="alamat_keterangan" 
                            value="{{ old('alamat_keterangan', $profil->alamat_keterangan ?? '') }}" 
                            style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 10px; font-size: 14px;"
                            placeholder="Contoh: 7G9P+GWW, Sunyaragi, Kec. Kesambi"
                        >
                        @error('alamat_keterangan')
                            <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">Link Google Maps</label>
                        <input 
                            type="url" 
                            name="maps_url" 
                            value="{{ old('maps_url', $profil->maps_url ?? '') }}" 
                            style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 10px; font-size: 14px;"
                            placeholder="https://maps.app.goo.gl/..."
                        >
                        @error('maps_url')
                            <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Contact Info Card -->
            <div style="background: #ffffff; border-radius: 16px; padding: 20px; box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                    <div style="width: 40px; height: 40px; border-radius: 999px; display: flex; align-items: center; justify-content: center; background-color: #ECB176;">
                        <svg style="width: 20px; height: 20px; color: #fff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <h3 style="font-size: 16px; font-weight: 700; color: #374151;">Hubungi Kami</h3>
                </div>
                <div style="display: grid; gap: 12px;">
                    <div>
                        <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">Telepon</label>
                        <input 
                            type="text" 
                            name="telepon" 
                            value="{{ old('telepon', $profil->telepon ?? '') }}" 
                            style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 10px; font-size: 14px;"
                            placeholder="Contoh: 0231-123456"
                        >
                        @error('telepon')
                            <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">Telepon Alternatif</label>
                        <input 
                            type="text" 
                            name="telepon_alt" 
                            value="{{ old('telepon_alt', $profil->telepon_alt ?? '') }}" 
                            style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 10px; font-size: 14px;"
                            placeholder="Contoh: 021-3900020"
                        >
                        @error('telepon_alt')
                            <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">WhatsApp</label>
                        <input
                            type="text"
                            name="whatsapp"
                            value="{{ old('whatsapp', $profil->whatsapp ?? '') }}"
                            style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 10px; font-size: 14px;"
                            placeholder="Contoh: 0895 0706 9859"
                        >
                        @error('whatsapp')
                            <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email', $profil->email ?? '') }}" 
                            style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 10px; font-size: 14px;"
                            placeholder="Contoh: info@kemenhaj-cirebon.go.id"
                        >
                        @error('email')
                            <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">Website</label>
                        <input 
                            type="url" 
                            name="website" 
                            value="{{ old('website', $profil->website ?? '') }}" 
                            style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 10px; font-size: 14px;"
                            placeholder="Contoh: https://kemenhaj-cirebon.go.id"
                        >
                        @error('website')
                            <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Media Section -->
        <div style="background: #ffffff; border-radius: 16px; padding: 20px; box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06); margin-bottom: 24px;">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 16px;">
                <div style="width: 40px; height: 40px; border-radius: 999px; display: flex; align-items: center; justify-content: center; background-color: #ECB176;">
                    <svg style="width: 20px; height: 20px; color: #fff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h6m-6 4h10M5 6a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6z"/>
                    </svg>
                </div>
                <h3 style="font-size: 16px; font-weight: 700; color: #374151;">Media Sosial</h3>
            </div>
            <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 12px;">
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">Facebook</label>
                    <input
                        type="url"
                        name="facebook"
                        value="{{ old('facebook', $profil->facebook ?? '') }}"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 10px; font-size: 14px;"
                        placeholder="https://facebook.com/..."
                    >
                    @error('facebook')
                        <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">Instagram</label>
                    <input
                        type="url"
                        name="instagram"
                        value="{{ old('instagram', $profil->instagram ?? '') }}"
                        style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 10px; font-size: 14px;"
                        placeholder="https://instagram.com/..."
                    >
                    @error('instagram')
                        <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Google Maps Section -->
        <div style="background: #ffffff; border-radius: 16px; box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06); overflow: hidden; margin-bottom: 24px;">
            <div style="padding: 16px 20px; border-bottom: 1px solid #e5e7eb;">
                <h2 style="font-size: 18px; font-weight: 700; color: #374151;">Lokasi Kami di Peta</h2>
                <p style="font-size: 13px; color: #6b7280; margin-top: 6px;">Masukkan URL embed Google Maps untuk ditampilkan di halaman publik.</p>
            </div>
            <div style="padding: 16px 20px;">
                <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">Embed Google Maps (URL iframe)</label>
                <textarea
                    name="maps_embed"
                    rows="3"
                    style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 10px; font-size: 14px; font-family: inherit; resize: vertical;"
                    placeholder="Contoh: https://www.google.com/maps?q=...&output=embed"
                >{{ old('maps_embed', $profil->maps_embed ?? '') }}</textarea>
                @error('maps_embed')
                    <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- KBIHU & PPIU Maps Section -->
        <div style="background: #ffffff; border-radius: 16px; box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06); overflow: hidden; margin-bottom: 24px;">
            <div style="padding: 16px 20px; border-bottom: 1px solid #e5e7eb;">
                <h2 style="font-size: 18px; font-weight: 700; color: #374151;">Lokasi KBIHU & PPIU di Peta</h2>
                <p style="font-size: 13px; color: #6b7280; margin-top: 6px;">Masukkan URL embed Google Maps untuk lokasi gabungan KBIHU dan PPIU di Kota Cirebon.</p>
            </div>
            <div style="padding: 16px 20px;">
                <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 6px; display: block;">Embed Google Maps KBIHU & PPIU (URL iframe)</label>
                <textarea
                    name="maps_embed_kbihu"
                    rows="3"
                    style="width: 100%; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 10px; font-size: 14px; font-family: inherit; resize: vertical;"
                    placeholder="Contoh: https://www.google.com/maps/d/u/5/embed?mid=..."
                >{{ old('maps_embed_kbihu', $profil->maps_embed_kbihu ?? '') }}</textarea>
                @error('maps_embed_kbihu')
                    <span style="color: #dc2626; font-size: 12px; margin-top: 4px; display: block;">{{ $message }}</span>
                @enderror
            </div>
        </div>


        <div style="display: flex; justify-content: flex-end;">
            <button type="submit" style="padding: 10px 20px; background-color: #ECB176; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
