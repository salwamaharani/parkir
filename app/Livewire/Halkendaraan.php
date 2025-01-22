<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Jeniskendaraan;

class Halkendaraan extends Component
{
    public $jenisKendaraan, $tarifPerJam;
    public function simpan(){
        $this->validate([
            'jenisKendaraan' => 'required',
            'tarifPerJam' => 'required|numeric'
        ]);
        Jeniskendaraan::updateOrCreate([
            'nama' => $this->jenisKendaraan
        ],[
            'tarif' => $this->tarifPerJam
        ]);
        $this->reset();
    }
    public function edit($id)
    {
        $jenisKendaraan = JenisKendaraan::find($id);
        $this->jenisKendaraan = $jenisKendaraan->nama;
        $this->tarifPerJam = $jenisKendaraan->tarif;
    }
    public function hapus($id)
{
    Jeniskendaraan::destroy($id);
}
    public function render()
    {
        return view('livewire.halkendaraan')->with([
            'parkingRates' => Jeniskendaraan::all()
        ]);
    }
}
