<?php

namespace App\Livewire;

use App\Models\Jeniskendaraan;
use Livewire\Component;
use App\Models\Riwayatparkir;

class Halinputparkir extends Component
{
    public $nomorPlat, $jenisKendaraan, $parkir_edit;

    // Fungsi untuk menyimpan data parkir
    public function simpan()
    {
        // Validasi input form
        $this->validate([
            'nomorPlat' => 'required',
            'jenisKendaraan' => 'required'
        ]);

        // Jika ada data yang diedit, update data tersebut
        if ($this->parkir_edit) {
            $this->parkir_edit->nomor_plat = $this->nomorPlat;
            $this->parkir_edit->jeniskendaraan_id = $this->jenisKendaraan;
            $this->parkir_edit->waktu_masuk = now();
            $this->parkir_edit->save();
        } else {
            // Jika tidak ada yang diedit, buat data baru
            Riwayatparkir::create([
                'nomor_plat' => $this->nomorPlat,
                'jeniskendaraan_id' => $this->jenisKendaraan,
                'waktu_masuk' => now()
            ]);
        }

        // Reset form setelah data disimpan
        $this->reset();
    }

    // Fungsi untuk mengedit data parkir
    public function edit($id)
    {
        $riwayatParkir = Riwayatparkir::find($id);

        // Mengisi nilai form dengan data yang diedit
        $this->parkir_edit = $riwayatParkir;
        $this->nomorPlat = $riwayatParkir->nomor_plat;
        $this->jenisKendaraan = $riwayatParkir->jeniskendaraan_id;
    }

    // Fungsi untuk menghapus data parkir
    public function hapus($id)
    {
        Riwayatparkir::destroy($id);
    }

    // Fungsi untuk menampilkan data ke view
    public function render()
    {
        return view('livewire.halinputparkir', [
            'riwayatParkir' => Riwayatparkir::whereNull('waktu_keluar')->get(),
            'jenisKendaraanOptions' => Jeniskendaraan::all()
        ]);
    }
}