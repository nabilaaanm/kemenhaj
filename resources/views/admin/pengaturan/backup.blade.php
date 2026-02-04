@extends('admin.layout')

@section('title', 'Backup Database')
@section('page-title', 'Backup Database')

@section('content')
<div class="card">
    <h3>Backup Database</h3>
    <p style="color: #6b7280; margin-bottom: 20px;">
        Fitur ini hanya tersedia untuk Admin. Backup akan dibuat dan langsung diunduh dalam format SQL.
    </p>

    @if (session('error'))
        <div style="padding: 12px 16px; background: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; border-radius: 10px; margin-bottom: 16px;">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.pengaturan.backup.download') }}">
        @csrf
        <button type="submit"
                style="padding: 12px 20px; background-color: #111827; color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 14px; cursor: pointer;">
            Download Backup Database
        </button>
    </form>

    <div style="margin-top: 20px; font-size: 12px; color: #6b7280;">
        Catatan: proses backup bisa memakan waktu jika database besar.
    </div>
</div>
@endsection
