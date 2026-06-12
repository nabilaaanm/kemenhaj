@once
<style>
    .active-toggle {
        display: block;
        cursor: pointer;
        user-select: none;
    }
    .active-toggle-input {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
        pointer-events: none;
    }
    .active-toggle-card {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 14px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        background: #f9fafb;
        transition: border-color 0.2s ease, background-color 0.2s ease, box-shadow 0.2s ease;
    }
    .active-toggle:hover .active-toggle-card {
        border-color: #d1d5db;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }
    .active-toggle-input:checked + .active-toggle-card {
        border-color: #86efac;
        background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
        box-shadow: 0 2px 12px rgba(16, 185, 129, 0.12);
    }
    .active-toggle-input:not(:checked) + .active-toggle-card {
        border-color: #e5e7eb;
        background: #f9fafb;
    }
    .active-toggle-switch {
        position: relative;
        flex-shrink: 0;
        width: 52px;
        height: 28px;
        border-radius: 999px;
        background: #d1d5db;
        transition: background-color 0.25s ease;
    }
    .active-toggle-input:checked + .active-toggle-card .active-toggle-switch {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }
    .active-toggle-knob {
        position: absolute;
        top: 3px;
        left: 3px;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.18);
        transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .active-toggle-input:checked + .active-toggle-card .active-toggle-knob {
        transform: translateX(24px);
    }
    .active-toggle-body {
        flex: 1;
        min-width: 0;
    }
    .active-toggle-title {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        font-size: 14px;
        color: #374151;
        line-height: 1.3;
    }
    .active-toggle-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 2px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.02em;
        text-transform: uppercase;
    }
    .active-toggle-badge-on {
        background: #dcfce7;
        color: #166534;
    }
    .active-toggle-badge-off {
        background: #fee2e2;
        color: #991b1b;
    }
    .active-toggle-badge-on {
        display: none;
    }
    .active-toggle-badge-off {
        display: inline-flex;
    }
    .active-toggle-input:checked + .active-toggle-card .active-toggle-badge-on {
        display: inline-flex;
    }
    .active-toggle-input:checked + .active-toggle-card .active-toggle-badge-off {
        display: none;
    }
    .active-toggle-desc {
        margin-top: 4px;
        font-size: 12px;
        color: #6b7280;
        line-height: 1.4;
    }
    .active-toggle-icon {
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }
    .active-toggle-input:checked + .active-toggle-card .active-toggle-icon-on {
        display: block;
        color: #059669;
    }
    .active-toggle-input:checked + .active-toggle-card .active-toggle-icon-off {
        display: none;
    }
    .active-toggle-input:not(:checked) + .active-toggle-card .active-toggle-icon-on {
        display: none;
    }
    .active-toggle-input:not(:checked) + .active-toggle-card .active-toggle-icon-off {
        display: block;
        color: #9ca3af;
    }
</style>
@endonce

@php
    $toggleName = $name ?? 'is_active';
    $toggleId = $id ?? $toggleName . '_' . uniqid();
    $toggleLabel = $label ?? 'Aktif';
    $toggleDescription = $description ?? 'Konten ditampilkan di website publik';
    $toggleChecked = (bool) ($checked ?? false);
@endphp

<label class="active-toggle" for="{{ $toggleId }}">
    <input
        type="checkbox"
        id="{{ $toggleId }}"
        name="{{ $toggleName }}"
        value="1"
        class="active-toggle-input"
        {{ $toggleChecked ? 'checked' : '' }}
    >
    <div class="active-toggle-card">
        <div class="active-toggle-switch" aria-hidden="true">
            <span class="active-toggle-knob"></span>
        </div>
        <div class="active-toggle-body">
            <div class="active-toggle-title">
                <svg class="active-toggle-icon active-toggle-icon-on" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <svg class="active-toggle-icon active-toggle-icon-off" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ $toggleLabel }}</span>
                <span class="active-toggle-badge active-toggle-badge-on">Aktif</span>
                <span class="active-toggle-badge active-toggle-badge-off">Nonaktif</span>
            </div>
            @if($toggleDescription)
                <p class="active-toggle-desc">{{ $toggleDescription }}</p>
            @endif
        </div>
    </div>
</label>
