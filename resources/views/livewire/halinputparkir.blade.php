<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="background-color: #f8f9fa; border-color: #ddd;">
                <div class="card-header" style="background-color: #007bff; color: white;">
                    Dashboard
                </div>
                <div class="card-body" style="background-color: #f8f9fa;">
                    <div class="container mt-4">
                        <!-- Form Input -->
                        <form class="mb-4" wire:submit.prevent="simpan">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label" for="nomorPlat">Nomor Plat</label>
                                    <input class="form-control" id="nomorPlat" type="text" wire:model="nomorPlat" placeholder="Masukkan nomor plat kendaraan">
                                    @error('nomorPlat')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label" for="jenisKendaraan">Jenis Kendaraan</label>
                                    <select class="form-select" id="jenisKendaraan" wire:model="jenisKendaraan">
                                        <option value="">Pilih jenis kendaraan</option>
                                        @foreach($jenisKendaraanOptions as $option)
                                            <option value="{{ $option->id }}">
                                                {{ $option->nama }} - Rp {{ number_format($option->tarif, 0, ',', '.') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('jenisKendaraan')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <button class="btn btn-primary" type="submit" wire:loading.attr="disabled">Simpan</button>
                        </form>

                        <hr />

                        <!-- Tabel Riwayat Parkir -->
                        <table class="table-bordered table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Plat</th>
                                    <th>Jenis Kendaraan</th>
                                    <th>Tarif Per Jam</th>
                                    <th>Waktu Masuk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($riwayatParkir as $rp)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $rp->nomor_plat }}</td>
                                        <td>{{ $rp->jeniskendaraan->nama }}</td>
                                        <td>Rp.{{ number_format($rp->jeniskendaraan->tarif, 0, ',', '.') }}</td>
                                        <td>{{ $rp->waktu_masuk }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning" wire:click="edit({{ $rp->id }})">Edit</button>
                                            <button class="btn btn-sm btn-danger" wire:click="hapus({{ $rp->id }})">Hapus</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="6">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>