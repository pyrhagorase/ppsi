<!DOCTYPE html>
<html>
<head>
    <title>Rekap Pemasukan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: left;
        }
        .total-row td {
            font-weight: bold;
        }
    </style>
</head>
<body>
    {{-- Update the title to reflect the date range --}}
    <h2>Rekap Servis Lunas Dari Tanggal: {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} Sampai Tanggal: {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</h2>
    <table>
        <thead>
            <tr>
                <th>ID Tracking</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Tipe Barang</th>
                <th>Status</th>
                <th>Biaya</th>
            </tr>
        </thead>
        <tbody>
            @forelse($servis as $item)
            <tr>
                <td>{{ $item->id_tracking }}</td>
                <td>{{ $item->nama_pelanggan }}</td>
                <td>{{ \Carbon\Carbon::parse($item->waktu_servis)->format('d-m-Y') }}</td>
                <td>{{ $item->tipe_barang }}</td>
                <td>{{ $item->statusservis }}</td>
                <td>Rp{{ number_format((int)preg_replace('/[^\d]/', '', $item->biaya), 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">Tidak ada data</td>
            </tr>
            @endforelse
            <tr class="total-row">
                <td colspan="5">Total Pemasukan</td>
                <td>Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>