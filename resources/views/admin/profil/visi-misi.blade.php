@extends('admin.layout')

@section('title', 'Profil - Visi & Misi')
@section('page-title', 'Profil - Visi & Misi')

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

    @php
        $rawMisi = $profil?->misi_konten ?? '';
        $decodedMisi = json_decode($rawMisi, true);
        $misiCards = is_array($decodedMisi) ? $decodedMisi : [];
        if (empty($misiCards)) {
            $misiCards = [['title' => '', 'description' => '']];
        }
    @endphp

    <form method="POST" action="{{ route('admin.profil.visi-misi.update') }}" style="max-width: 1000px; margin: 0 auto;">
        @csrf
        <input type="hidden" name="redirect_to" value="admin.profil.visi-misi">

        <div style="margin-bottom: 24px;">
            <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 10px; display: block;">Visi</label>
            <textarea
                name="visi_konten"
                rows="4"
                placeholder="Tuliskan visi..."
                style="width: 100%; padding: 12px 14px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; font-family: inherit; resize: vertical;"
            >{{ old('visi_konten', $profil?->visi_konten) }}</textarea>
        </div>

        <div style="display: grid; gap: 16px; margin-bottom: 24px;">
            <div>
                <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 10px; display: block;">Kartu Misi</label>
                <div style="display: flex; justify-content: flex-end; margin-bottom: 10px;">
                    <button type="button" id="addMisiCard" style="padding: 6px 12px; background-color: #ECB176; color: white; border: none; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer;">
                        + Tambah Card
                    </button>
                </div>
                <div id="misiCardsWrapper" style="display: grid; gap: 14px;">
                    @foreach($misiCards as $i => $card)
                        <div class="misi-card-item" style="border: 1px solid #e5e7eb; border-radius: 12px; padding: 14px; background: #f9fafb;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <div class="misi-card-title" style="font-weight: 600; font-size: 13px; color: #374151;">Card {{ $i + 1 }}</div>
                                <button type="button" class="removeMisiCard" style="padding: 4px 10px; background-color: #ef4444; color: white; border: none; border-radius: 6px; font-size: 11px; cursor: pointer;">
                                    Hapus
                                </button>
                            </div>
                            <div style="display: grid; gap: 10px;">
                                <div>
                                    <label style="font-size: 11px; font-weight: 600; color: #6b7280; margin-bottom: 4px; display: block;">Judul Misi</label>
                                    <input
                                        type="text"
                                        name="misi_cards[{{ $i }}][title]"
                                        value="{{ old("misi_cards.$i.title", $card['title'] ?? '') }}"
                                        placeholder="Contoh: Pelayanan Prima"
                                        style="width: 100%; padding: 8px 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 13px;"
                                    >
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 600; color: #6b7280; margin-bottom: 4px; display: block;">Deskripsi</label>
                                    <textarea
                                        name="misi_cards[{{ $i }}][description]"
                                        rows="3"
                                        placeholder="Tulis deskripsi misi..."
                                        style="width: 100%; padding: 8px 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 13px; font-family: inherit; resize: vertical;"
                                    >{{ old("misi_cards.$i.description", $card['description'] ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('misi_cards.*.title')
                    <span style="color: #dc2626; font-size: 12px; margin-top: 6px; display: block;">{{ $message }}</span>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const wrapper = document.getElementById('misiCardsWrapper');
        const addButton = document.getElementById('addMisiCard');

        const createLabel = (text) => {
            const label = document.createElement('label');
            label.textContent = text;
            label.style.cssText = 'font-size: 11px; font-weight: 600; color: #6b7280; margin-bottom: 4px; display: block;';
            return label;
        };

        const createInput = (name, placeholder, value = '') => {
            const input = document.createElement('input');
            input.type = 'text';
            input.name = name;
            input.value = value;
            input.placeholder = placeholder;
            input.style.cssText = 'width: 100%; padding: 8px 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 13px;';
            return input;
        };

        const createTextarea = (name, placeholder, value = '') => {
            const textarea = document.createElement('textarea');
            textarea.name = name;
            textarea.rows = 3;
            textarea.value = value;
            textarea.placeholder = placeholder;
            textarea.style.cssText = 'width: 100%; padding: 8px 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 13px; font-family: inherit; resize: vertical;';
            return textarea;
        };

        const createCard = (index) => {
            const card = document.createElement('div');
            card.className = 'misi-card-item';
            card.style.cssText = 'border: 1px solid #e5e7eb; border-radius: 12px; padding: 14px; background: #f9fafb;';
            card.innerHTML = `
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <div class="misi-card-title" style="font-weight: 600; font-size: 13px; color: #374151;">Card ${index + 1}</div>
                    <button type="button" class="removeMisiCard" style="padding: 4px 10px; background-color: #ef4444; color: white; border: none; border-radius: 6px; font-size: 11px; cursor: pointer;">
                        Hapus
                    </button>
                </div>
                <div style="display: grid; gap: 10px;">
                    <div class="misi-card-field"></div>
                    <div class="misi-card-field"></div>
                </div>
            `;

            const fields = card.querySelectorAll('.misi-card-field');
            fields[0].appendChild(createLabel('Judul Misi'));
            fields[0].appendChild(createInput(`misi_cards[${index}][title]`, 'Contoh: Pelayanan Prima'));
            fields[1].appendChild(createLabel('Deskripsi'));
            fields[1].appendChild(createTextarea(`misi_cards[${index}][description]`, 'Tulis deskripsi misi...'));

            return card;
        };

        const reindexCards = () => {
            const cards = wrapper.querySelectorAll('.misi-card-item');
            cards.forEach((card, index) => {
                const title = card.querySelector('.misi-card-title');
                if (title) {
                    title.textContent = `Card ${index + 1}`;
                }
                const inputs = card.querySelectorAll('input, textarea');
                inputs.forEach((input) => {
                    const field = input.name.split('[').pop().replace(']', '');
                    input.name = `misi_cards[${index}][${field}]`;
                });
            });
        };

        wrapper.addEventListener('click', function (event) {
            if (event.target.classList.contains('removeMisiCard')) {
                const card = event.target.closest('.misi-card-item');
                if (card) {
                    card.remove();
                    if (!wrapper.querySelector('.misi-card-item')) {
                        wrapper.appendChild(createCard(0));
                    }
                    reindexCards();
                }
            }
        });

        addButton.addEventListener('click', function () {
            const newIndex = wrapper.querySelectorAll('.misi-card-item').length;
            wrapper.appendChild(createCard(newIndex));
        });
    });
</script>
@endsection
