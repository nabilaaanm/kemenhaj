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
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Gambar Struktur Organisasi</label>
                @if(!empty($profil?->struktur_gambar_url))
                    <div style="margin-bottom: 12px;">
                        <img src="{{ $profil->struktur_gambar_url }}" alt="Struktur Organisasi" style="max-width: 100%; height: auto; border-radius: 8px; border: 1px solid #d1d5db;">
                    </div>
                    <button type="submit" name="hapus_struktur_gambar" value="1" style="margin-bottom: 12px; padding: 8px 14px; background-color: #ef4444; color: white; border: none; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer;">
                        Hapus Gambar
                    </button>
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
            </div>

            @php
                $rowSlots = [
                    1 => [1, 2, 3, 4],
                    2 => [1, 2, 3, 4],
                    3 => [1, 2, 3, 4],
                ];
                $maxRows = 3;
                $grid = [];
                $unassigned = collect();
                foreach (($tim ?? collect()) as $member) {
                    $baris = (int) ($member->baris ?? 0);
                    $slot = (int) ($member->slot ?? 0);
                    if ($baris && $slot && in_array($slot, $rowSlots[$baris] ?? [], true)) {
                        $grid[$baris][$slot] = $member;
                    } else {
                        $unassigned->push($member);
                    }
                }
                foreach ($unassigned as $member) {
                    $placed = false;
                    for ($row = 1; $row <= $maxRows; $row++) {
                        foreach ($rowSlots[$row] as $slot) {
                            if (empty($grid[$row][$slot])) {
                                $grid[$row][$slot] = $member;
                                $placed = true;
                                break;
                            }
                        }
                        if ($placed) {
                            break;
                        }
                    }
                }
            @endphp

            @for($rowIndex = 1; $rowIndex <= $maxRows; $rowIndex++)
                <div style="margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                        <h4 style="font-size: 14px; font-weight: 700; color: #374151; margin: 0;">Baris {{ $rowIndex }}</h4>
                        <button type="button" onclick="openTimModal(null, {{ $rowIndex }})" style="padding: 6px 12px; background-color: #ECB176; color: white; border: none; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer;">
                            + Tambah Anggota
                        </button>
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 20px; width: 100%;">
                        @for($col = 1; $col <= 4; $col++)
                            @if(in_array($col, $rowSlots[$rowIndex], true))
                                @php $member = $grid[$rowIndex][$col] ?? null; @endphp
                                @if($member)
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
                                @else
                                    <div style="background: #ffffff; border: 2px dashed #e5e7eb; border-radius: 12px; padding: 16px; text-align: center; color: #9ca3af;">
                                        <div style="height: 120px; width: 120px; border-radius: 50%; background: #f3f4f6; margin: 0 auto 12px;"></div>
                                        <p style="font-size: 12px; margin: 0;">Slot kosong</p>
                                    </div>
                                @endif
                            @else
                                <div></div>
                            @endif
                        @endfor
                    </div>
                </div>
            @endfor
    </div>
</div>

@include('admin.profil.tim-modal')
@endsection
