<div>
    <style>
        /* Ubah warna header dashboard */
        .card-header {
            background-color: #007BFF; /* Biru */
            color: white;
        }

        /* Ubah warna body dashboard */
        .card-body {
            background-color: #f8f9fa; /* Abu-abu terang */
           
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <div class="container mt-4">
                            <form class="mb-4" wire:submit.prevent="simpan">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="jenisKendaraan">Jenis Kendaraan</label>
                                        <input class="form-control" id="jenisKendaraan" type="text" wire:model="jenisKendaraan"
                                            placeholder="Masukkan jenis kendaraan">
                                        @error('jenisKendaraan')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="tarifPerJam">Tarif Per Jam</label>
                                        <input class="form-control" id="tarifPerJam" type="number" wire:model="tarifPerJam"
                                            placeholder="Masukkan tarif per jam">
                                        @error('tarifPerJam')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Simpan</button>
                            </form>
                            <hr />
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Kendaraan</th>
                                        <th>Tarif Per Jam</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($parkingRates as $index => $rate)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $rate['nama'] }}</td>
                                        <td>Rp {{ number_format($rate['tarif'], 0, ',', '.') }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-warning" wire:click="edit({{ $rate['id'] }})">Edit</button>
                                            <button class="btn btn-sm btn-danger" wire:click="hapus({{ $rate['id'] }})">Hapus</button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="4">Tidak ada data</td>
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
</div>