<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Parkir</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 9px;
            margin: 10px;
        }
        .header, .footer {
            text-align: center;
        }
        .footer {
            font-size: 7px;
            margin-top: 10px;
        }
        .table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }
        .table td {
            padding: 5px;
            border: 1px solid #ddd;
            font-size: 8px;
        }
        .table th {
            padding: 5px;
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            font-size: 8px;
        }
        .bold {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>{{ $detailparkir['tempatparkir'] }}</h3>
        <p>{{ $detailparkir['deskripsi'] }}</p>
        <hr>
    </div>

    <p><span class="bold">No PLAT:</span> {{ $detailparkir['noplat'] }}</p>
    <p><span class="bold">Jenis Kendaraan:</span> {{ $detailparkir['jeniskendaraanditemukan'] }}</p>
    <p><span class="bold">Tarif Per Jam:</span> Rp. {{ number_format($detailparkir['tarifperjam'], 0, ',', '.') }}</p>
    <p><span class="bold">Waktu Masuk:</span> {{ $detailparkir['waktumasuk'] }}</p>
    <p><span class="bold">Waktu Keluar:</span> {{ $detailparkir['waktukeluar'] }}</p>

    <table class="table">
        <tr>
            <td><span class="bold">Lama Parkir:</span></td>
            <td>
                {{ $detailparkir['durasi'] }} <!-- Durasi sudah diformat di controller -->
            </td>
        </tr>
        <tr>
            <td><span class="bold">Total Biaya:</span></td>
            <td>Rp. {{ number_format($detailparkir['totalbiaya'], 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>Terima kasih telah menggunakan layanan parkir kami.</p>
        <p>*** Harap simpan struk ini sebagai bukti pembayaran ***</p>
    </div>
</body>
</html>