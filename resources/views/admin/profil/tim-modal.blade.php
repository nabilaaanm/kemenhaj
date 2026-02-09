<!-- Modal Tambah/Edit Tim -->
<div id="timModal" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
    @php
        $rowSlots = $rowSlots ?? [1 => [1,2,3,4], 2 => [1,2,3,4], 3 => [1,2,3,4]];
    @endphp
    <div style="background: white; border-radius: 12px; padding: 24px; max-width: 500px; width: 90%; max-height: 90vh; overflow-y: auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h3 id="modalTitle" style="font-size: 20px; font-weight: 700; color: #1f2937; margin: 0;">Tambah Anggota Tim</h3>
            <button type="button" onclick="closeTimModal()" style="background: none; border: none; font-size: 24px; color: #6b7280; cursor: pointer;">&times;</button>
        </div>
        
        <form id="timForm" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Nama</label>
                <input type="text" name="nama" id="tim_nama" required
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Jabatan</label>
                <input type="text" name="jabatan" id="tim_jabatan" required
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
            </div>
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Foto</label>
                <input type="file" name="foto" id="tim_foto" accept="image/*"
                       style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
                <p style="font-size: 12px; color: #6b7280; margin-top: 4px;">Format: JPG, PNG, maksimal 2MB</p>
                <div id="tim_foto_preview" style="margin-top: 12px;"></div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; margin-bottom: 20px;">
                <div>
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Baris</label>
                    <select name="baris" id="tim_baris" required
                            style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
                        @foreach($rowSlots as $row => $slots)
                            <option value="{{ $row }}">Baris {{ $row }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #374151;">Slot</label>
                    <select name="slot" id="tim_slot" required
                            style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px;">
                    </select>
                </div>
            </div>
            
            <div style="display: flex; gap: 12px; justify-content: flex-end;">
                <button type="button" onclick="closeTimModal()" style="padding: 10px 20px; background-color: #e5e7eb; color: #374151; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;">
                    Batal
                </button>
                <button type="submit" style="padding: 10px 20px; background-color: #ECB176; color: white; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer;">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let timData = @json($tim ?? []);

function buildSlotOptions(row, selectedSlot = null) {
    const slotSelect = document.getElementById('tim_slot');
    if (!slotSelect) return;

    const slotsByRow = @json($rowSlots);
    const slots = slotsByRow[row] || [];
    const usedSlots = new Set();

    timData.forEach(member => {
        if (Number(member.baris) === Number(row) && member.slot) {
            usedSlots.add(Number(member.slot));
        }
    });

    if (selectedSlot) {
        usedSlots.delete(Number(selectedSlot));
    }

    slotSelect.innerHTML = '';
    slots.forEach(slot => {
        const option = document.createElement('option');
        option.value = slot;
        option.textContent = `Slot ${slot}`;
        if (usedSlots.has(slot)) {
            option.disabled = true;
        }
        if (Number(selectedSlot) === slot) {
            option.selected = true;
        }
        slotSelect.appendChild(option);
    });
}

function openTimModal(id = null, defaultRow = null) {
    const modal = document.getElementById('timModal');
    const form = document.getElementById('timForm');
    const title = document.getElementById('modalTitle');
    
    // Reset form
    form.reset();
    document.getElementById('tim_foto_preview').innerHTML = '';
    
    const barisSelect = document.getElementById('tim_baris');

    if (id) {
        const member = timData.find(t => t.id === id);
        if (member) {
            title.textContent = 'Edit Anggota Tim';
            form.action = '{{ route("admin.profil.tim.update", ":id") }}'.replace(':id', id);
            
            let methodInput = form.querySelector('input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                form.appendChild(methodInput);
            }
            methodInput.value = 'PUT';
            
            document.getElementById('tim_nama').value = member.nama || '';
            document.getElementById('tim_jabatan').value = member.jabatan || '';
            if (barisSelect) {
                barisSelect.value = member.baris || 1;
            }
            buildSlotOptions(Number(barisSelect?.value || 1), member.slot || null);
            
            if (member.foto_url) {
                document.getElementById('tim_foto_preview').innerHTML = 
                    `<img src="${member.foto_url}" alt="${member.nama}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 2px solid #ECB176;">`;
            }
        }
    } else {
        title.textContent = 'Tambah Anggota Tim';
        form.action = '{{ route("admin.profil.tim.store") }}';
        
        let methodInput = form.querySelector('input[name="_method"]');
        if (methodInput) {
            methodInput.remove();
        }
        if (barisSelect) {
            barisSelect.value = defaultRow || 1;
        }
        buildSlotOptions(Number(barisSelect?.value || 1));
    }
    
    modal.style.display = 'flex';
}

function editTim(id) {
    openTimModal(id);
}

function closeTimModal() {
    document.getElementById('timModal').style.display = 'none';
    document.getElementById('timForm').reset();
    document.getElementById('tim_foto_preview').innerHTML = '';
}

document.addEventListener('DOMContentLoaded', function() {
    const fotoInput = document.getElementById('tim_foto');
    const barisSelect = document.getElementById('tim_baris');
    if (fotoInput) {
        fotoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('tim_foto_preview').innerHTML = 
                        `<img src="${e.target.result}" alt="Preview" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 2px solid #ECB176;">`;
                };
                reader.readAsDataURL(file);
            }
        });
    }
    if (barisSelect) {
        barisSelect.addEventListener('change', function() {
            buildSlotOptions(Number(barisSelect.value));
        });
    }
    
    const modal = document.getElementById('timModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeTimModal();
            }
        });
    }
});
</script>
