@if (file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@elseif (file_exists(public_path('build/manifest.json')))
    @php
        $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        $cssFile = $manifest['resources/css/app.css']['file'] ?? null;
        $jsFile = $manifest['resources/js/app.js']['file'] ?? null;
    @endphp
    @if ($cssFile)
        <link rel="stylesheet" href="{{ asset('build/' . $cssFile) }}">
    @endif
    @if ($jsFile)
        <script src="{{ asset('build/' . $jsFile) }}" defer></script>
    @endif
@else
    <link rel="stylesheet" href="{{ asset('build/assets/app-Byobma2p.css') }}">
    <script src="{{ asset('build/assets/app-CAiCLEjY.js') }}" defer></script>
@endif
