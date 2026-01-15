@extends('admin.layout')

@section('title', 'Panduan Pengguna')
@section('page-title', 'Panduan Pengguna')

@section('content')
@php
    $userRole = session('user.role', 'kontributor');
@endphp

<div class="card">
    <h3>Panduan Pengguna Sistem Admin</h3>
    <p style="color: #6b7280; margin-bottom: 32px;">
        Panduan lengkap penggunaan sistem admin Kementerian Haji dan Umrah Kota Cirebon.
        @if($userRole === 'kontributor')
            <br><strong style="color: #374151;">Role Anda: Kontributor</strong> - Anda dapat mengelola posting dan melihat dashboard.
        @elseif($userRole === 'editor')
            <br><strong style="color: #374151;">Role Anda: Editor</strong> - Anda dapat mengelola posting, halaman, galeri, layanan, dan regulasi.
        @else
            <br><strong style="color: #374151;">Role Anda: Admin</strong> - Anda memiliki akses penuh ke semua fitur sistem.
        @endif
    </p>
    
    <div style="color: #374151; line-height: 1.8;">
        
        <!-- Dashboard -->
        <div style="margin-bottom: 32px; padding: 24px; background-color: #f9fafb; border-radius: 12px; border-left: 4px solid #ECB176;">
            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 12px; color: #1f2937;">1. Dashboard</h4>
            <p style="margin-bottom: 16px; color: #6b7280;">Halaman utama admin yang menampilkan ringkasan informasi dan statistik sistem.</p>
            <div style="background-color: white; padding: 16px; border-radius: 8px; margin-top: 12px;">
                <strong style="color: #374151;">Langkah-langkah:</strong>
                <ol style="margin: 12px 0 0 20px; color: #6b7280;">
                    <li>Setelah login, Anda akan langsung diarahkan ke halaman Dashboard</li>
                    <li>Dashboard menampilkan ringkasan data dan statistik sistem</li>
                    <li>Gunakan menu sidebar untuk navigasi ke halaman lain</li>
                    <li>Di topbar, Anda dapat melihat informasi akun Anda dan tombol "Beranda" untuk melihat website publik</li>
                </ol>
            </div>
        </div>

        <!-- Posting -->
        <div style="margin-bottom: 32px; padding: 24px; background-color: #f9fafb; border-radius: 12px; border-left: 4px solid #ECB176;">
            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 12px; color: #1f2937;">2. Posting</h4>
            <p style="margin-bottom: 16px; color: #6b7280;">
                Kelola konten posting termasuk berita, pengumuman, siaran pers, dan klarifikasi hoax. 
                Dapat diakses oleh Admin, Editor, dan Kontributor.
            </p>
            <div style="background-color: white; padding: 16px; border-radius: 8px; margin-top: 12px;">
                <strong style="color: #374151;">Langkah-langkah Menambah Posting:</strong>
                <ol style="margin: 12px 0 0 20px; color: #6b7280;">
                    <li>Klik menu <strong>"Posting"</strong> di sidebar, lalu pilih <strong>"Tambah"</strong></li>
                    <li>Isi form dengan judul, konten, kategori, dan informasi lainnya</li>
                    <li>Upload gambar thumbnail jika diperlukan (format: JPG, PNG)</li>
                    <li>Pilih kategori posting (Berita, Pengumuman, Siaran Pers, atau Hoax)</li>
                    <li>Pastikan semua field yang wajib diisi sudah terisi</li>
                    <li>Klik tombol <strong>"Simpan"</strong> untuk menyimpan posting</li>
                    <li>Anda akan melihat notifikasi sukses jika posting berhasil disimpan</li>
                </ol>
                <strong style="color: #374151; display: block; margin-top: 16px;">Langkah-langkah Melihat Posting:</strong>
                <ol style="margin: 12px 0 0 20px; color: #6b7280;">
                    <li>Klik menu <strong>"Posting"</strong> di sidebar, lalu pilih <strong>"Lihat"</strong></li>
                    <li>Anda akan melihat daftar semua posting yang telah dibuat</li>
                    <li>Gunakan filter untuk mencari posting berdasarkan kategori</li>
                    <li>Klik tombol <strong>"Edit"</strong> untuk mengubah posting</li>
                    <li>Klik tombol <strong>"Hapus"</strong> untuk menghapus posting (akan muncul konfirmasi)</li>
                </ol>
                <strong style="color: #374151; display: block; margin-top: 16px;">Menu Kategori Posting:</strong>
                <ul style="margin: 12px 0 0 20px; color: #6b7280;">
                    <li><strong>Kategori:</strong> Kelola kategori posting</li>
                    <li><strong>Berita:</strong> Lihat dan kelola posting berita</li>
                    <li><strong>Pengumuman:</strong> Lihat dan kelola posting pengumuman</li>
                    <li><strong>Siaran Pers:</strong> Lihat dan kelola posting siaran pers</li>
                    <li><strong>Hoax:</strong> Lihat dan kelola klarifikasi hoax</li>
                </ul>
            </div>
        </div>

        @if(in_array($userRole, ['admin', 'editor']))
        <!-- Halaman -->
        <div style="margin-bottom: 32px; padding: 24px; background-color: #f9fafb; border-radius: 12px; border-left: 4px solid #ECB176;">
            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 12px; color: #1f2937;">3. Halaman</h4>
            <p style="margin-bottom: 16px; color: #6b7280;">Buat dan kelola halaman statis website. Hanya dapat diakses oleh Admin dan Editor.</p>
            <div style="background-color: white; padding: 16px; border-radius: 8px; margin-top: 12px;">
                <strong style="color: #374151;">Langkah-langkah Menambah Halaman:</strong>
                <ol style="margin: 12px 0 0 20px; color: #6b7280;">
                    <li>Klik menu <strong>"Halaman"</strong> di sidebar, lalu pilih <strong>"Tambah Halaman"</strong></li>
                    <li>Isi judul halaman yang akan ditampilkan</li>
                    <li>Isi konten halaman menggunakan editor teks</li>
                    <li>Atur URL slug untuk halaman (opsional, akan otomatis dibuat dari judul)</li>
                    <li>Pastikan semua field yang wajib diisi sudah terisi</li>
                    <li>Klik tombol <strong>"Simpan"</strong> untuk membuat halaman baru</li>
                </ol>
                <strong style="color: #374151; display: block; margin-top: 16px;">Langkah-langkah Melihat Halaman:</strong>
                <ol style="margin: 12px 0 0 20px; color: #6b7280;">
                    <li>Klik menu <strong>"Halaman"</strong> di sidebar, lalu pilih <strong>"Lihat Halaman"</strong></li>
                    <li>Anda akan melihat daftar semua halaman yang telah dibuat</li>
                    <li>Klik tombol <strong>"Edit"</strong> untuk mengubah halaman</li>
                    <li>Klik tombol <strong>"Hapus"</strong> untuk menghapus halaman (akan muncul konfirmasi)</li>
                </ol>
            </div>
        </div>

        <!-- Galeri -->
        <div style="margin-bottom: 32px; padding: 24px; background-color: #f9fafb; border-radius: 12px; border-left: 4px solid #ECB176;">
            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 12px; color: #1f2937;">4. Galeri</h4>
            <p style="margin-bottom: 16px; color: #6b7280;">Kelola foto, video, dan infografis untuk ditampilkan di website. Hanya dapat diakses oleh Admin dan Editor.</p>
            <div style="background-color: white; padding: 16px; border-radius: 8px; margin-top: 12px;">
                <strong style="color: #374151;">Langkah-langkah Menambah Foto:</strong>
                <ol style="margin: 12px 0 0 20px; color: #6b7280;">
                    <li>Klik menu <strong>"Galeri"</strong> di sidebar, lalu pilih <strong>"Tambah Foto"</strong></li>
                    <li>Upload file foto (format: JPG, PNG, maksimal sesuai batas server)</li>
                    <li>Isi judul foto yang deskriptif</li>
                    <li>Isi deskripsi foto (opsional)</li>
                    <li>Pilih kategori foto (Kegiatan, Informasi, atau Tutorial)</li>
                    <li>Klik tombol <strong>"Simpan"</strong> untuk menambahkan foto</li>
                    <li>Foto akan muncul di halaman galeri publik setelah disimpan</li>
                </ol>
                <strong style="color: #374151; display: block; margin-top: 16px;">Langkah-langkah Menambah Video:</strong>
                <ol style="margin: 12px 0 0 20px; color: #6b7280;">
                    <li>Klik menu <strong>"Galeri"</strong> di sidebar, lalu pilih <strong>"Tambah Video"</strong></li>
                    <li><strong>Opsi 1:</strong> Upload file video (format: MP4, maksimal sesuai batas PHP)</li>
                    <li><strong>Opsi 2:</strong> Masukkan URL YouTube atau Vimeo (disarankan untuk file besar)</li>
                    <li>Isi judul video yang deskriptif</li>
                    <li>Isi deskripsi video (opsional)</li>
                    <li>Pilih kategori video (Kegiatan, Informasi, atau Tutorial)</li>
                    <li>Upload thumbnail jika diperlukan (opsional)</li>
                    <li>Klik tombol <strong>"Simpan"</strong> untuk menambahkan video</li>
                    <li><strong>Catatan:</strong> Jika menggunakan URL, video akan otomatis ter-embed di halaman publik</li>
                </ol>
                <strong style="color: #374151; display: block; margin-top: 16px;">Langkah-langkah Menambah Infografis:</strong>
                <ol style="margin: 12px 0 0 20px; color: #6b7280;">
                    <li>Klik menu <strong>"Galeri"</strong> di sidebar, lalu pilih <strong>"Tambah Infografis"</strong></li>
                    <li>Upload file infografis (format: JPG, PNG, maksimal sesuai batas server)</li>
                    <li>Isi judul infografis yang deskriptif</li>
                    <li>Isi deskripsi infografis (opsional)</li>
                    <li>Pilih kategori infografis (Kegiatan, Informasi, atau Tutorial)</li>
                    <li>Klik tombol <strong>"Simpan"</strong> untuk menambahkan infografis</li>
                </ol>
                <strong style="color: #374151; display: block; margin-top: 16px;">Langkah-langkah Melihat Galeri:</strong>
                <ol style="margin: 12px 0 0 20px; color: #6b7280;">
                    <li>Klik menu <strong>"Galeri"</strong> di sidebar, lalu pilih <strong>"Lihat Foto/Video/Infografis"</strong></li>
                    <li>Anda akan melihat daftar semua item galeri yang telah dibuat</li>
                    <li>Klik tombol <strong>"Hapus"</strong> untuk menghapus item (akan muncul konfirmasi)</li>
                </ol>
            </div>
        </div>

        <!-- Layanan -->
        <div style="margin-bottom: 32px; padding: 24px; background-color: #f9fafb; border-radius: 12px; border-left: 4px solid #ECB176;">
            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 12px; color: #1f2937;">5. Layanan</h4>
            <p style="margin-bottom: 16px; color: #6b7280;">Kelola informasi layanan yang tersedia di website. Hanya dapat diakses oleh Admin dan Editor.</p>
            <div style="background-color: white; padding: 16px; border-radius: 8px; margin-top: 12px;">
                <strong style="color: #374151;">Langkah-langkah Menambah Layanan:</strong>
                <ol style="margin: 12px 0 0 20px; color: #6b7280;">
                    <li>Klik menu <strong>"Layanan"</strong> di sidebar, lalu pilih <strong>"Tambah Layanan"</strong></li>
                    <li>Isi nama layanan (contoh: SISKOPATUH)</li>
                    <li>Isi deskripsi layanan (opsional)</li>
                    <li>Masukkan URL layanan (link aplikasi layanan, akan dibuka di tab baru)</li>
                    <li>Upload icon layanan (format: JPG, PNG, maksimal 2MB)</li>
                    <li>Atur urutan tampilan (angka lebih kecil muncul lebih dulu, default: 0)</li>
                    <li>Klik tombol <strong>"Simpan Layanan"</strong> untuk menyimpan</li>
                    <li>Layanan akan muncul di halaman layanan publik setelah disimpan</li>
                </ol>
                <strong style="color: #374151; display: block; margin-top: 16px;">Langkah-langkah Melihat Layanan:</strong>
                <ol style="margin: 12px 0 0 20px; color: #6b7280;">
                    <li>Klik menu <strong>"Layanan"</strong> di sidebar, lalu pilih <strong>"Lihat Layanan"</strong></li>
                    <li>Anda akan melihat daftar semua layanan yang telah dibuat</li>
                    <li>Klik tombol <strong>"Edit"</strong> untuk mengubah layanan</li>
                    <li>Klik tombol <strong>"Hapus"</strong> untuk menghapus layanan (akan muncul konfirmasi)</li>
                </ol>
            </div>
        </div>

        <!-- Regulasi -->
        <div style="margin-bottom: 32px; padding: 24px; background-color: #f9fafb; border-radius: 12px; border-left: 4px solid #ECB176;">
            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 12px; color: #1f2937;">6. Regulasi</h4>
            <p style="margin-bottom: 16px; color: #6b7280;">Kelola dokumen regulasi dan peraturan yang ditampilkan di website. Hanya dapat diakses oleh Admin dan Editor.</p>
            <div style="background-color: white; padding: 16px; border-radius: 8px; margin-top: 12px;">
                <strong style="color: #374151;">Langkah-langkah Menambah Regulasi:</strong>
                <ol style="margin: 12px 0 0 20px; color: #6b7280;">
                    <li>Klik menu <strong>"Regulasi"</strong> di sidebar, lalu pilih <strong>"Tambah Regulasi"</strong></li>
                    <li>Isi judul regulasi yang jelas dan deskriptif</li>
                    <li>Isi deskripsi regulasi (opsional)</li>
                    <li>Pilih kategori regulasi dari dropdown</li>
                    <li>Pilih tanggal regulasi (tanggal diterbitkan)</li>
                    <li>Upload file PDF regulasi (format: PDF, maksimal sesuai batas server)</li>
                    <li>Atur urutan tampilan (angka lebih kecil muncul lebih dulu, default: 0)</li>
                    <li>Klik tombol <strong>"Simpan Regulasi"</strong> untuk menyimpan</li>
                    <li>Regulasi akan muncul di halaman regulasi publik setelah disimpan</li>
                </ol>
                <strong style="color: #374151; display: block; margin-top: 16px;">Langkah-langkah Melihat Regulasi:</strong>
                <ol style="margin: 12px 0 0 20px; color: #6b7280;">
                    <li>Klik menu <strong>"Regulasi"</strong> di sidebar, lalu pilih <strong>"Lihat Regulasi"</strong></li>
                    <li>Anda akan melihat daftar semua regulasi yang telah dibuat</li>
                    <li>Klik tombol <strong>"Edit"</strong> untuk mengubah regulasi</li>
                    <li>Klik tombol <strong>"Hapus"</strong> untuk menghapus regulasi (akan muncul konfirmasi)</li>
                    <li>Klik link <strong>"Lihat PDF"</strong> untuk melihat dokumen regulasi di tab baru</li>
                </ol>
            </div>
        </div>
        @endif

        @if($userRole === 'admin')
        <!-- Pengaturan -->
        <div style="margin-bottom: 32px; padding: 24px; background-color: #f9fafb; border-radius: 12px; border-left: 4px solid #ECB176;">
            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 12px; color: #1f2937;">7. Pengaturan</h4>
            <p style="margin-bottom: 16px; color: #6b7280;">Konfigurasi umum sistem, modul, tampilan, slideshow, dan pengguna. Hanya dapat diakses oleh Admin.</p>
            <div style="background-color: white; padding: 16px; border-radius: 8px; margin-top: 12px;">
                <strong style="color: #374151;">Menu Pengaturan:</strong>
                <ul style="margin: 12px 0 0 20px; color: #6b7280;">
                    <li><strong>Umum:</strong> Konfigurasi nama instansi, kota, dan lambang</li>
                    <li><strong>Modul:</strong> Aktifkan/nonaktifkan modul sistem</li>
                    <li><strong>Tampilan:</strong> Pengaturan tema dan tampilan website</li>
                    <li><strong>Slideshow:</strong> Kelola gambar slideshow di halaman utama</li>
                    <li><strong>Pengguna:</strong> Kelola pengguna sistem (tambah, edit, hapus pengguna dengan role kontributor atau editor)</li>
                </ul>
                <strong style="color: #374151; display: block; margin-top: 16px;">Langkah-langkah Mengelola Pengguna:</strong>
                <ol style="margin: 12px 0 0 20px; color: #6b7280;">
                    <li>Klik menu <strong>"Pengaturan"</strong> di sidebar, lalu pilih <strong>"Pengguna"</strong></li>
                    <li>Anda akan melihat daftar semua pengguna sistem</li>
                    <li>Klik tombol <strong>"Tambah Pengguna"</strong> di kanan atas untuk menambah pengguna baru</li>
                    <li>Isi nama lengkap pengguna</li>
                    <li>Isi email pengguna (harus unik, belum terdaftar)</li>
                    <li>Isi password dan konfirmasi password (minimal 6 karakter)</li>
                    <li>Pilih role: <strong>Kontributor</strong> atau <strong>Editor</strong> (tidak bisa membuat admin baru)</li>
                    <li>Klik tombol <strong>"Simpan Pengguna"</strong> untuk menyimpan</li>
                    <li>Untuk mengedit, klik tombol <strong>"Edit"</strong> pada pengguna yang ingin diubah</li>
                    <li>Untuk menghapus, klik tombol <strong>"Hapus"</strong> (hanya untuk non-admin, akan muncul konfirmasi)</li>
                    <li><strong>Catatan:</strong> Anda tidak dapat menghapus akun sendiri</li>
                </ol>
            </div>
        </div>
        @endif

        <!-- Tips -->
        <div style="margin-top: 40px; padding: 24px; background-color: #eff6ff; border-radius: 12px; border-left: 4px solid #3b82f6;">
            <h4 style="font-size: 18px; font-weight: 600; margin-bottom: 12px; color: #1e40af;">Tips & Trik</h4>
            <ul style="margin: 12px 0 0 20px; color: #1e40af;">
                <li>Gunakan tombol <strong>"Beranda"</strong> di topbar untuk melihat website publik di tab baru</li>
                <li>Pastikan file yang diupload tidak melebihi batas maksimal yang ditentukan</li>
                <li>Untuk video, gunakan URL YouTube/Vimeo jika file terlalu besar (lebih efisien)</li>
                <li>Gunakan fitur filter dan pencarian untuk menemukan konten dengan cepat</li>
                <li>Selalu periksa preview sebelum menyimpan konten</li>
                <li>Notifikasi sukses/error akan muncul otomatis di pojok kanan atas</li>
                <li>Gunakan tombol "Kembali" untuk kembali ke halaman sebelumnya tanpa menyimpan perubahan</li>
                @if($userRole === 'kontributor')
                <li><strong>Untuk Kontributor:</strong> Anda hanya dapat mengelola posting. Jika perlu akses lebih, hubungi Admin.</li>
                @elseif($userRole === 'editor')
                <li><strong>Untuk Editor:</strong> Anda dapat mengelola posting, halaman, galeri, layanan, dan regulasi. Untuk pengaturan sistem, hubungi Admin.</li>
                @endif
            </ul>
        </div>

    </div>
</div>
@endsection
