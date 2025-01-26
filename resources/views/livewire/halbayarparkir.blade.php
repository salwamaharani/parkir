<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="background-color: #f9f9f9; border-color: #ccc;">
                <div class="card-header" style="background-color: #007BFF; color: white;">
                    Dashboard Pembayaran Parkir
                </div>
                <div class="card-body" style="background-color: #f8f9fa;">
                    <!-- Form Pencarian -->
                    @if(!$sudahBayar)
                        <form class="mb-4" wire:submit.prevent="cariPlat">
                            <div class="input-group">
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    wire:model="nomorPlat" 
                                    placeholder="Cari Nomor Kendaraan" 
                                />
                                <button class="btn btn-primary" type="submit">Cari</button>
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
                                <td>{{ $jeniskendaraanditemukan ?? 'Tidak Diketahui' }}</td>
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
                                <td>{{ $lamajam }} Jam</td> <!-- Menampilkan Jam Saja -->
                            </tr>
                            <tr>
                                <td>Total Biaya</td>
                                <td>:</td>
                                <td>Rp. {{ number_format($totalbiaya, 0, ',', '.') }}</td>
                            </tr>
                        </table>

                        <!-- Tombol Bayar dan Cetak -->
                        @if(!$sudahBayar)
                            <a href="{{ url('cetak_pdf/'.$noplat) }}" target="_blank" class="btn btn-success" wire:click="bayar">Bayar dan Cetak</a>
                        @endif
                    @elseif($sudahBayar)
                        <div class="alert alert-success">
                            Pembayaran telah selesai. Terima kasih!
                        </div>
                    @endif
                    <hr />

                    <!-- Riwayat Parkir -->
                    <h5>Riwayat Parkir</h5>
                    <table class="table table-bordered">
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
                                    <td>{{ $rp->jeniskendaraan->nama ?? 'Tidak Diketahui' }}</td>
                                    <td>Rp {{ number_format($rp->jeniskendaraan->tarif ?? 0, 0, ',', '.') }}</td>
                                    <td>{{ $rp->waktu_masuk }}</td>
                                    <td>{{ $rp->waktu_keluar }}</td>
                                    <td>{{ $rp->durasi }} Jam</td> <!-- Menampilkan Jam Saja -->
                                    <td>Rp {{ number_format($rp->biaya, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada riwayat parkir.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
