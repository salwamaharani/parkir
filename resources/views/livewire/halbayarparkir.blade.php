<div class="container mt-4">
	<div class="row justify-content-center">
		<div class="col-md-12">
			<div class="card" style="background-color: #f9f9f9; border-color: #ccc;">
				<div class="card-header" style="background-color: #007BFF; color: white;">
					Dashboard
				</div>

				<div class="card-body" style="background-color: #f8f9fa;">
					<!-- Form Pencarian -->
					@if (!$sudahBayar)
						<form class="mb-4" wire:submit.prevent="cariPlat">
							<div class="input-group">
								<input type="text" class="form-control" wire:model="nomorPlat" placeholder="Cari Nomor Kendaraan" />
								<button class="btn btn-primary" type="button" wire:click="cariPlat">Cari</button>
							</div>
						</form>
						<hr />
					@endif

					<!-- Catatan -->
					@if ($catatan)
						<div class="alert alert-info">{{ $catatan }}</div>
					@endif

					<!-- Detail Parkir -->
					@if ($parkirDitemukan && !$sudahBayar)
						<table class="table">
							<tr>
								<td>Nomor Plat</td>
								<td>:</td>
								<td>{{ $noplat }}</td>
							</tr>
							<tr>
								<td>Jenis Kendaraan</td>
								<td>:</td>
								<td>{{ $jeniskendaraanditemukan }}</td>
							</tr>
							<tr>
								<td>Tarif Per Jam</td>
								<td>:</td>
								<td>Rp. {{ number_format($tarifperjam, 0, ',', '.') }}</td>
							</tr>
							<tr>
								<td>Waktu Masuk</td>
								<td>:</td>
								<td>{{ $waktumasuk }}</td>
							</tr>
							<tr>
								<td>Waktu Keluar</td>
								<td>:</td>
								<td>{{ $waktukeluar }}</td>
							</tr>
							<tr>
								<td>Lama Jam</td>
								<td>:</td>
								<td>{{ $lamajam }} Jam</td>
							</tr>
							<tr>
								<td>Total Biaya</td>
								<td>:</td>
								<td>Rp. {{ number_format($totalbiaya, 0, ',', '.') }}</td>
							</tr>
						</table>

						<!-- Tombol Bayar -->
						<button class="btn btn-success" wire:click="bayar">Bayar dan Cetak</button>
					@elseif($sudahBayar)
						<div class="alert alert-success">
							Pembayaran telah selesai. Terima kasih!
						</div>
						<div class="alert alert-info">
							<h5 class="text-center">Struk Parkir</h5>
							<hr>
							<div class="row" id="cetakparkir">
								<div class="col-12">
									<table class="table-borderless table">
										<tr>
											<td>No Plat</td>
											<td>:</td>
											<td>{{ $informasibayarparkir['noplat'] }}</td>
										</tr>
										<tr>
											<td>Jenis Kendaraan</td>
											<td>:</td>
											<td>{{ $informasibayarparkir['jeniskendaraanditemukan'] }}</td>
										</tr>
										<tr>
											<td>Tarif Per Jam</td>
											<td>:</td>
											<td>Rp. {{ number_format($informasibayarparkir['tarifperjam'], 0, ',', '.') }}</td>
										</tr>
										<tr>
											<td>Waktu Masuk</td>
											<td>:</td>
											<td>{{ $informasibayarparkir['waktumasuk'] }}</td>
										</tr>
										<tr>
											<td>Waktu Keluar</td>
											<td>:</td>
											<td>{{ $informasibayarparkir['waktukeluar'] }}</td>
										</tr>
										<tr>
											<td>Lama Parkir</td>
											<td>:</td>
											<td>{{ $informasibayarparkir['lamajam'] }} Jam</td>
										</tr>
										<tr>
											<td>Durasi</td>
											<td>:</td>
											<td>{{ $informasibayarparkir['durasi'] }} Jam</td>
										</tr>
										<tr>
											<td><strong>Total Biaya</strong></td>
											<td>:</td>
											<td><strong>Rp. {{ number_format($informasibayarparkir['totalbiaya'], 0, ',', '.') }}</strong></td>
										</tr>
									</table>

								</div>
							</div>
							<div class="text-center">
								<a href="{{ url('/cetak_pdf/'.$informasibayarparkir['noplat']) }}" target="_blank"  class="btn btn-primary" id="tombolcetak">
									<i class="fas fa-print"></i> Cetak Struk
                                </a>
							</div>
						</div>
					@endif
					<hr />

					<!-- Riwayat Parkir -->
					<h5>Riwayat Parkir</h5>
					<table class="table-bordered table">
						<thead style="background-color: #007BFF; color: white;">
							<tr>
								<th>No</th>
								<th>No Plat</th>
								<th>Jenis Kendaraan</th>
								<th>Tarif Per Jam</th>
								<th>Waktu Masuk</th>
								<th>Waktu Keluar</th>
								<th>Durasi</th>
								<th>Total Bayar</th>
							</tr>
						</thead>
						<tbody>
							@forelse ($riwayatParkir as $rp)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $rp->nomor_plat }}</td>
									<td>{{ $rp->jeniskendaraan->nama }}</td>
									<td>Rp {{ number_format($rp->jeniskendaraan->tarif, 0, ',', '.') }}</td>
									<td>{{ $rp->waktu_masuk }}</td>
									<td>{{ $rp->waktu_keluar }}</td>
									<td>{{ $rp->durasi }}</td>
									<td>Rp {{ number_format($rp->biaya, 0, ',', '.') }}</td>
								</tr>
							@empty
								<tr>
									<td colspan="8" class="text-center">Tidak ada data</td>
								</tr>
							@endforelse
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
