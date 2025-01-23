<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>

<body>
	No PLAT : {{ $detailparkir['noplat'] }} <br>
	Jenis Kendaraan : {{ $detailparkir['jeniskendaraanditemukan'] }} <br>
	Tarif Per Jam : Rp. {{ number_format($detailparkir['tarifperjam'], 0, ',', '.') }} <br>
	Waktu Masuk : {{ $detailparkir['waktumasuk'] }} <br>
	Waktu Keluar : {{ $detailparkir['waktukeluar'] }} <br>
	Lama Parkir : {{ $detailparkir['lamajam'] }} Jam <br>
	Total Biaya : Rp. {{ number_format($detailparkir['lamajam'] * $detailparkir['tarifperjam'], 0, ',', '.') }}
</body>

</html>
