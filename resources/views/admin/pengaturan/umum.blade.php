@extends('admin.layout')

@section('title', 'Pengaturan Umum')
@section('page-title', 'Pengaturan Umum')

@section('content')
<div class="card">
    <h3>Pengaturan Umum</h3>
    <form method="POST" action="{{ route('admin.pengaturan.umum.update') }}" enctype="multipart/form-data">
        @csrf
        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Nama Kemenhaj</label>
            <input type="text" name="nama_kemenhaj" value="Kementerian Haji dan Umrah" 
                   class="form-input" style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
        </div>
        
        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Kota</label>
            <input type="text" name="kota" value="Kota Cirebon" 
                   class="form-input" style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
        </div>
        
        <div style="margin-bottom: 24px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Lambang Kemenhaj</label>
            <div style="margin-bottom: 12px;">
                <img src="{{ asset('image/lambang.png') }}" alt="Lambang" style="height: 80px; width: auto; border: 1px solid #d1d5db; border-radius: 8px; padding: 8px;">
            </div>
            <input type="file" name="lambang" accept="image/*" 
                   style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
            <p style="font-size: 12px; color: #6b7280; margin-top: 4px;">Format: PNG, JPG, maksimal 2MB</p>
        </div>
        
        <button type="submit" style="padding: 12px 24px; background-color: #ECB176; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;">
            Simpan Pengaturan
        </button>
    </form>
</div>
@endsection
