<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Nota Servis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            /* Ukuran font sedikit lebih kecil untuk kesan struk */
            margin: 10px;
            /* Margin lebih kecil */
            color: #000;
        }

        .header {
            text-align: center;
            border-bottom: 1px dashed #000;
            /* Garis putus-putus untuk kesan struk */
            padding-bottom: 5px;
            /* Padding lebih kecil */
            margin-bottom: 10px;
            /* Margin lebih kecil */
        }

        .header h2 {
            margin: 0;
            font-size: 16px;
            /* Ukuran font header lebih kecil */
        }

        .header p {
            margin: 1px 0;
            /* Margin lebih kecil */
            font-size: 10px;
            /* Ukuran font detail header lebih kecil */
        }

        .info-table,
        .item-table,
        .totals-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
            /* Margin lebih kecil */
        }

        .info-table td {
            padding: 2px;
            /* Padding lebih kecil */
            vertical-align: top;
        }

        .item-table th,
        .item-table td {
            border: none;
            /* Hilangkan border penuh */
            border-bottom: 1px dashed #DDD;
            /* Garis putus-putus di bawah setiap baris item */
            padding: 4px;
            /* Padding lebih kecil */
        }

        .item-table th {
            background-color: transparent;
            /* Hilangkan background abu-abu */
            text-align: left;
            /* Biarkan rata kiri untuk No dan Nama Item */
        }

        .item-table th.right,
        .item-table td.right {
            text-align: right;
            /* Tetap rata kanan untuk harga */
        }

        .totals-table td {
            padding: 2px;
            /* Padding lebih kecil */
            border-top: 1px dashed #000;
            /* Garis putus-putus di atas total */
            border-bottom: 1px dashed #000;
            /* Garis putus-putus di bawah kembalian */
        }

        .totals-table .label {
            width: 70%;
            font-weight: bold;
        }

        .totals-table tr td:last-child {
            /* Target the last td in each row of totals-table */
            text-align: right;
            /* Ensure it's right-aligned */
            font-weight: bold;
            /* Keep the numbers bold */
        }

        .signature {
            margin-top: 15px;
            /* Margin lebih kecil */
            text-align: center;
            /* Rata tengah untuk footer */
            font-size: 10px;
            /* Ukuran font footer lebih kecil */
        }

        /* Style baru untuk footer */
        .nota-footer {
            text-align: center;
            margin-top: 20px;
            /* Jarak dari konten atas */
            font-size: 10px;
        }

        .nota-footer p {
            margin: 2px 0;
            /* Margin antar baris pesan */
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Sentra Computer</h2>
        <p>Jl. Pattimura RT 06 Kel. Kenali Besar, Kec. Alam Barajo, Kota Jambi</p>
        <p>WA: 08192400624</p>
    </div>

    <table class="info-table">
        <tr>
            <td><strong>ID Tracking:</strong> {{ $nota->id_tracking }}</td>
            <td class="right"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($nota->tanggal)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <td><strong>Kasir:</strong> {{ $nota->kasir }}</td>
            <td class="right"><strong>Status:</strong> {{ ucfirst($nota->status) }}</td>
        </tr>
        <tr>
            <td><strong>Metode Bayar:</strong> {{ $nota->metode_bayar }}</td>
            <td></td>
        </tr>
    </table>

    <table class="item-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th>Nama Item</th>
                <th style="width: 30%;" class="right">Harga (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($nota->items as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->nama_item }}</td>
                <td class="right">{{ number_format($item->harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <table class="totals-table">
        <tr>
            <td class="label">Total</td>
            <td class="right">Rp {{ number_format($total, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="label">Dibayar</td>
            <td class="right">Rp {{ number_format($dibayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td class="label">Kembalian</td>
            <td class="right">Rp {{ number_format($kembalian, 0, ',', '.') }}</td>
        </tr>
    </table>

    {{-- Footer baru --}}
    <div class="nota-footer">
        <p>Thank You For Your Trust</p>
        <p>We Always Provide The Best</p>
    </div>

</body>

</html>