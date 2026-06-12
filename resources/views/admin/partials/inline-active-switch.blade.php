@once
<style>
    .inline-active-switch {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        user-select: none;
        border: none;
        background: transparent;
        padding: 0;
        font: inherit;
    }
    .inline-active-switch:focus-visible {
        outline: 2px solid #ECB176;
        outline-offset: 2px;
        border-radius: 999px;
    }
    .inline-active-switch-track {
        position: relative;
        width: 44px;
        height: 24px;
        border-radius: 999px;
        background: #d1d5db;
        transition: background-color 0.25s ease;
        flex-shrink: 0;
    }
    .inline-active-switch.is-on .inline-active-switch-track {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }
    .inline-active-switch-knob {
        position: absolute;
        top: 2px;
        left: 2px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
        transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .inline-active-switch.is-on .inline-active-switch-knob {
        transform: translateX(20px);
    }
    .inline-active-switch-label {
        font-size: 12px;
        font-weight: 700;
        min-width: 58px;
        text-align: left;
    }
    .inline-active-switch.is-on .inline-active-switch-label {
        color: #166534;
    }
    .inline-active-switch:not(.is-on) .inline-active-switch-label {
        color: #991b1b;
    }
</style>
@endonce

@php
    $switchActive = (bool) ($active ?? false);
    $switchId = $id ?? 'switch_' . uniqid();
@endphp

<button
    type="button"
    id="{{ $switchId }}"
    class="inline-active-switch js-posting-active-switch {{ $switchActive ? 'is-on' : '' }}"
    data-post-id="{{ $postId }}"
    data-active="{{ $switchActive ? '1' : '0' }}"
    data-title="{{ $title ?? 'Posting' }}"
    aria-pressed="{{ $switchActive ? 'true' : 'false' }}"
    aria-label="{{ $switchActive ? 'Nonaktifkan posting' : 'Aktifkan posting' }}"
>
    <span class="inline-active-switch-track" aria-hidden="true">
        <span class="inline-active-switch-knob"></span>
    </span>
    <span class="inline-active-switch-label">{{ $switchActive ? 'Aktif' : 'Nonaktif' }}</span>
</button>
