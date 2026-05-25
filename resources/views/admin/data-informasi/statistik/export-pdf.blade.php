<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Statistik Haji — {{ $meta['periode_label'] }}</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 9px;
            color: #1f2937;
            margin: 0;
            padding: 0;
        }
        .header {
            background: linear-gradient(135deg, #16213e 0%, #1a365d 100%);
            color: #fff;
            padding: 18px 20px 14px;
            margin-bottom: 14px;
        }
        .header h1 {
            font-size: 16px;
            margin: 0 0 4px;
            font-weight: 700;
            letter-spacing: 0.2px;
        }
        .header .subtitle {
            font-size: 9px;
            opacity: 0.85;
            margin: 0;
        }
        .badges {
            margin-top: 10px;
        }
        .badge {
            display: inline-block;
            background: #ecb176;
            color: #16213e;
            font-weight: 700;
            font-size: 10px;
            padding: 5px 12px;
            border-radius: 20px;
            margin-right: 8px;
        }
        .badge.outline {
            background: rgba(255,255,255,0.15);
            color: #fff;
            border: 1px solid rgba(255,255,255,0.35);
        }
        .content { padding: 0 16px 16px; }
        .summary {
            display: table;
            width: 100%;
            margin-bottom: 12px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            overflow: hidden;
        }
        .summary-cell {
            display: table-cell;
            width: 33.33%;
            padding: 10px 12px;
            background: #f9fafb;
            border-right: 1px solid #e5e7eb;
            vertical-align: top;
        }
        .summary-cell:last-child { border-right: none; }
        .summary-label {
            font-size: 7px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6b7280;
            margin-bottom: 3px;
        }
        .summary-value {
            font-size: 11px;
            font-weight: 700;
            color: #111827;
        }
        table.data {
            width: 100%;
            border-collapse: collapse;
            border-radius: 6px;
            overflow: hidden;
        }
        table.data th {
            background: #16213e;
            color: #fff;
            font-size: 8px;
            font-weight: 700;
            padding: 6px 5px;
            text-align: left;
            border: 1px solid #16213e;
        }
        table.data td {
            border: 1px solid #e5e7eb;
            padding: 4px 5px;
            vertical-align: top;
            font-size: 8px;
        }
        table.data tr:nth-child(even) td { background: #f9fafb; }
        .empty {
            text-align: center;
            color: #6b7280;
            padding: 24px;
            font-style: italic;
        }
        .footer {
            margin-top: 12px;
            font-size: 7px;
            color: #9ca3af;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Data Statistik Haji</h1>
        <p class="subtitle">Kementerian Haji dan Umrah — Kota Cirebon</p>
        <div class="badges">
            <span class="badge">{{ $meta['judul'] }}</span>
            <span class="badge outline">{{ $meta['periode_label'] }}</span>
        </div>
    </div>

    <div class="content">
        <div class="summary">
            <div class="summary-cell">
                <div class="summary-label">Periode data</div>
                <div class="summary-value">{{ $meta['periode_label'] }}</div>
            </div>
            <div class="summary-cell">
                <div class="summary-label">Jumlah baris</div>
                <div class="summary-value">{{ number_format($total) }}</div>
            </div>
            <div class="summary-cell">
                <div class="summary-label">Waktu ekspor</div>
                <div class="summary-value">{{ $exportedAt }}</div>
            </div>
        </div>

        <table class="data">
            <thead>
                <tr>
                    @foreach ($headers as $header)
                        <th>{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse ($rows as $row)
                    <tr>
                        @foreach ($row as $cell)
                            <td>{{ $cell }}</td>
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($headers) }}" class="empty">Tidak ada data untuk periode ini</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <p class="footer">Dokumen ini dihasilkan otomatis dari sistem admin Kemenhaj Kota Cirebon</p>
    </div>
</body>
</html>
