<!DOCTYPE html>
<html>
<head>
    <title>Rekap Pemasukan</title>
    <style>
        body {
            font-family: 'Times New Roman', serif; /* Classic font */
            margin: 20px;
            background-color: #f8f8f8; /* Very light, off-white background */
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border: 1px solid #ddd; /* Subtle border */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); /* Very light shadow */
        }
        /* Header Styles */
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #ccc; /* Thicker, classic separator line */
        }
        .header h2 {
            margin: 0 0 5px 0;
            color: #222; /* Darker, traditional black */
            font-size: 28px;
            text-transform: uppercase; /* Classic formal look */
        }
        .header p {
            margin: 0;
            font-size: 13px;
            color: #555;
        }

        h2.report-title { /* Added a class for the main report title */
            text-align: center;
            margin-bottom: 25px;
            color: #444; /* Slightly softer dark gray */
            font-size: 22px;
            font-weight: normal; /* Less emphasis than company name */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px; /* Slightly smaller for density */
            border: 1px solid #ccc; /* Overall table border */
            margin-bottom: 25px;
        }
        th, td {
            border: 1px solid #e0e0e0; /* Light gray borders for cells */
            padding: 10px 12px; /* Consistent padding */
            text-align: left;
        }
        th {
            background-color: #f2f2f2; /* Subtle light gray header background */
            color: #333;
            font-weight: bold;
            text-transform: uppercase; /* Uppercase headers for formality */
            font-size: 12px; /* Slightly smaller header font */
        }
        tbody tr:nth-child(even) {
            background-color: #fafafa; /* Very subtle zebra striping */
        }
        .total-row td {
            font-weight: bold;
            background-color: #e6e6e6; /* Medium gray for total row */
            color: #000;
            padding: 12px;
            border-top: 2px solid #bbb; /* Stronger top border for total */
        }
        td:nth-child(6) {
            text-align: right;
        }
        .empty-data {
            text-align: center;
            color: #777;
            padding: 20px;
            font-style: italic;
        }

        /* Footer Styles */
        .nota-footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #ccc; /* Thicker, classic separator line */
            color: #555;
            font-size: 13px;
        }
        .nota-footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Sentra Computer</h2>
            <p>Jl. Pattimura RT 06 Kel. Kenali Besar, Kec. Alam Barajo, Kota Jambi</p>
            <p>WA: 08192400624</p>
        </div>

        <h2 class="report-title">Rekap Servis Lunas Dari Tanggal: {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} Sampai Tanggal: {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</h2>
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
                    <td colspan="6" class="empty-data">Tidak ada data servis yang lunas dalam periode ini.</td>
                </tr>
                @endforelse
                <tr class="total-row">
                    <td colspan="5">Total Pemasukan</td>
                    <td>Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="owner-footer">
            <p>&copy; {{ date('Y') }} Sentra Computer. Hak Cipta Dilindungi.</p>
        </div>
    </div>
</body>
</html>