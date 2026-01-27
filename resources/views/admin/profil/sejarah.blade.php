@extends('admin.layout')

@section('title', 'Profil - Sejarah')
@section('page-title', 'Profil - Sejarah')

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
        $rawSejarah = $profil?->sejarah_konten ?? '';
        $decodedSejarah = json_decode($rawSejarah, true);
        $sejarahCards = is_array($decodedSejarah) ? $decodedSejarah : [];
        if (empty($sejarahCards)) {
            $sejarahCards = [['label' => '', 'period' => '', 'title' => '', 'description' => '']];
        }
        $hasSejarah = !empty($rawSejarah);
    @endphp

    <form method="POST" action="{{ route('admin.profil.sejarah.update') }}" style="max-width: 1000px; margin: 0 auto;">
        @csrf
        <input type="hidden" name="redirect_to" value="admin.profil.sejarah">

        <div style="display: grid; gap: 16px; margin-bottom: 24px;">
            <div>
                <label style="font-size: 12px; font-weight: 600; color: #6b7280; margin-bottom: 10px; display: block;">Kartu Sejarah</label>
                <div style="display: flex; justify-content: flex-end; margin-bottom: 10px;">
                    <button type="button" id="addSejarahCard" style="padding: 6px 12px; background-color: #ECB176; color: white; border: none; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer;">
                        + Tambah Card
                    </button>
                </div>
                <div id="sejarahCardsWrapper" style="display: grid; gap: 14px;">
                    @foreach($sejarahCards as $i => $card)
                        <div class="sejarah-card-item" style="border: 1px solid #e5e7eb; border-radius: 12px; padding: 14px; background: #f9fafb;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <div class="sejarah-card-title" style="font-weight: 600; font-size: 13px; color: #374151;">Card {{ $i + 1 }}</div>
                                <button type="button" class="removeSejarahCard" style="padding: 4px 10px; background-color: #ef4444; color: white; border: none; border-radius: 6px; font-size: 11px; cursor: pointer;">
                                    Hapus
                                </button>
                            </div>
                            <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; margin-bottom: 10px;">
                                <div>
                                    <label style="font-size: 11px; font-weight: 600; color: #6b7280; margin-bottom: 4px; display: block;">Label Kiri</label>
                                    <input
                                        type="text"
                                        name="sejarah_cards[{{ $i }}][label]"
                                        value="{{ old("sejarah_cards.$i.label", $card['label'] ?? '') }}"
                                        placeholder="Contoh: Awal Mula"
                                        style="width: 100%; padding: 8px 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 13px;"
                                    >
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 600; color: #6b7280; margin-bottom: 4px; display: block;">Periode Kiri</label>
                                    <input
                                        type="text"
                                        name="sejarah_cards[{{ $i }}][period]"
                                        value="{{ old("sejarah_cards.$i.period", $card['period'] ?? '') }}"
                                        placeholder="Contoh: Periode Awal"
                                        style="width: 100%; padding: 8px 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 13px;"
                                    >
                                </div>
                            </div>
                            <div style="display: grid; gap: 10px;">
                                <div>
                                    <label style="font-size: 11px; font-weight: 600; color: #6b7280; margin-bottom: 4px; display: block;">Judul Card</label>
                                    <input
                                        type="text"
                                        name="sejarah_cards[{{ $i }}][title]"
                                        value="{{ old("sejarah_cards.$i.title", $card['title'] ?? '') }}"
                                        placeholder="Contoh: Pembentukan Kantor Perwakilan"
                                        style="width: 100%; padding: 8px 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 13px;"
                                    >
                                </div>
                                <div>
                                    <label style="font-size: 11px; font-weight: 600; color: #6b7280; margin-bottom: 4px; display: block;">Deskripsi</label>
                                    <textarea
                                        name="sejarah_cards[{{ $i }}][description]"
                                        rows="3"
                                        placeholder="Tulis deskripsi card..."
                                        style="width: 100%; padding: 8px 10px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 13px; font-family: inherit; resize: vertical;"
                                    >{{ old("sejarah_cards.$i.description", $card['description'] ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('sejarah_cards.*.title')
                    <span style="color: #dc2626; font-size: 12px; margin-top: 6px; display: block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="margin-bottom: 24px;">
            @if($hasSejarah)
                <div style="background: #ffffff; border-radius: 16px; padding: 20px; box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);">
                    <div style="max-width: 840px; margin: 0 auto;">
                        @foreach($sejarahCards as $card)
                            @php
                                $emptyCard = empty($card['label']) && empty($card['period']) && empty($card['title']) && empty($card['description']);
                            @endphp
                            @continue($emptyCard)
                            <div style="margin-bottom: 18px; position: relative;">
                                <div style="display: flex; gap: 20px;">
                                    <div style="width: 30%; text-align: right; padding-right: 16px;">
                                        <div style="font-size: 18px; font-weight: 700; color: #93c5fd;">{{ $card['label'] }}</div>
                                        <div style="font-size: 12px; color: #6b7280;">{{ $card['period'] }}</div>
                                    </div>
                                    <div style="width: 70%; position: relative;">
                                        <div style="position: absolute; left: -10px; top: 0; bottom: 0; width: 4px; background: #93c5fd;"></div>
                                        <div style="margin-left: 10px;">
                                            <div style="position: absolute; left: -14px; top: 6px; width: 12px; height: 12px; border-radius: 999px; background: #93c5fd; border: 3px solid #ffffff;"></div>
                                            <div style="background: #ffffff; border-radius: 14px; box-shadow: 0 4px 10px rgba(0,0,0,0.08); padding: 16px;">
                                                <div style="font-size: 16px; font-weight: 700; color: #374151; margin-bottom: 6px;">
                                                    {{ $card['title'] }}
                                                </div>
                                                <div style="font-size: 13px; color: #4b5563; line-height: 1.6;">
                                                    {!! nl2br(e($card['description'])) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div style="background: #f9fafb; border: 2px dashed #e5e7eb; border-radius: 16px; padding: 28px; text-align: center; color: #9ca3af;">
                    <div style="font-size: 16px; font-weight: 600; margin-bottom: 6px;">Coming Soon</div>
                    <div style="font-size: 13px;">Konten sejarah belum tersedia.</div>
                </div>
            @endif
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
        const wrapper = document.getElementById('sejarahCardsWrapper');
        const addButton = document.getElementById('addSejarahCard');

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
            card.className = 'sejarah-card-item';
            card.style.cssText = 'border: 1px solid #e5e7eb; border-radius: 12px; padding: 14px; background: #f9fafb;';
            card.innerHTML = `
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <div class="sejarah-card-title" style="font-weight: 600; font-size: 13px; color: #374151;">Card ${index + 1}</div>
                    <button type="button" class="removeSejarahCard" style="padding: 4px 10px; background-color: #ef4444; color: white; border: none; border-radius: 6px; font-size: 11px; cursor: pointer;">
                        Hapus
                    </button>
                </div>
                <div class="sejarah-card-grid" style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; margin-bottom: 10px;">
                    <div class="sejarah-card-field"></div>
                    <div class="sejarah-card-field"></div>
                </div>
                <div style="display: grid; gap: 10px;">
                    <div class="sejarah-card-field"></div>
                    <div class="sejarah-card-field"></div>
                </div>
            `;

            const fields = card.querySelectorAll('.sejarah-card-field');
            fields[0].appendChild(createLabel('Label Kiri'));
            fields[0].appendChild(createInput(`sejarah_cards[${index}][label]`, 'Contoh: Awal Mula'));
            fields[1].appendChild(createLabel('Periode Kiri'));
            fields[1].appendChild(createInput(`sejarah_cards[${index}][period]`, 'Contoh: Periode Awal'));
            fields[2].appendChild(createLabel('Judul Card'));
            fields[2].appendChild(createInput(`sejarah_cards[${index}][title]`, 'Contoh: Pembentukan Kantor Perwakilan'));
            fields[3].appendChild(createLabel('Deskripsi'));
            fields[3].appendChild(createTextarea(`sejarah_cards[${index}][description]`, 'Tulis deskripsi card...'));

            return card;
        };

        const createLabel = (text) => {
            const label = document.createElement('label');
            label.textContent = text;
            label.style.cssText = 'font-size: 11px; font-weight: 600; color: #6b7280; margin-bottom: 4px; display: block;';
            return label;
        };

        const reindexCards = () => {
            const cards = wrapper.querySelectorAll('.sejarah-card-item');
            cards.forEach((card, index) => {
                const title = card.querySelector('.sejarah-card-title');
                if (title) {
                    title.textContent = `Card ${index + 1}`;
                }
                const inputs = card.querySelectorAll('input, textarea');
                inputs.forEach((input) => {
                    const field = input.name.split('[').pop().replace(']', '');
                    input.name = `sejarah_cards[${index}][${field}]`;
                });
            });
        };

        wrapper.addEventListener('click', function (event) {
            if (event.target.classList.contains('removeSejarahCard')) {
                const card = event.target.closest('.sejarah-card-item');
                if (card) {
                    card.remove();
                    if (!wrapper.querySelector('.sejarah-card-item')) {
                        wrapper.appendChild(createCard(0));
                    }
                    reindexCards();
                }
            }
        });

        addButton.addEventListener('click', function () {
            const newIndex = wrapper.querySelectorAll('.sejarah-card-item').length;
            wrapper.appendChild(createCard(newIndex));
        });
    });
</script>
@endsection
