<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Parkir;
use App\Models\RiwayatParkir;
use Carbon\Carbon;


class Halbayarparkir extends Component
{
    // Properti untuk data dan logika
    public $nomorPlat, $catatan, $parkirDitemukan;
    public $noplat, $jeniskendaraanditemukan, $tarifperjam, $waktumasuk, $waktukeluar, $lamajam, $totalbiaya;
    public $sudahBayar = false;
    public $informasibayarparkir;

    /**
     * Cari data parkir berdasarkan nomor plat
     */
    public function cariPlat()
    {
        $this->parkirDitemukan = RiwayatParkir::where('nomor_plat', $this->nomorPlat)->whereNull('waktu_keluar')->first();

        if ($this->parkirDitemukan) {
            $this->catatan = 'Parkir ditemukan';
            $this->noplat = $this->parkirDitemukan->nomor_plat;
            $this->jeniskendaraanditemukan = $this->parkirDitemukan->jeniskendaraan->nama;
            $this->tarifperjam = $this->parkirDitemukan->jeniskendaraan->tarif;
            $this->waktumasuk = $this->parkirDitemukan->waktu_masuk;
            $this->waktukeluar = Carbon::now()->format('Y-m-d H:i:s');
            $this->lamajam = Carbon::parse($this->waktumasuk)->diffInHours(Carbon::parse($this->waktukeluar));


            // Hitung total biaya
            $this->totalbiaya = ($this->lamajam < 1)
                ? $this->tarifperjam
                : $this->lamajam * $this->tarifperjam;
        } else {
            $this->catatan = 'Parkir tidak ditemukan';
        }
    }

    /**
     * Proses pembayaran parkir
     */
    public function bayar()
    {
        if ($this->parkirDitemukan) {

            $this->parkirDitemukan->update([
                'waktu_keluar' => $this->waktukeluar, // Update waktu keluar
                'durasi' => $this->lamajam,           // Update durasi parkir
                'biaya' => $this->totalbiaya,         // Update total biaya
            ]);
            $detailparkir = RiwayatParkir::where('nomor_plat', $this->parkirDitemukan->nomor_plat)->whereNotNull('waktu_keluar')->first();
            $this->sudahBayar = true;
            $this->resetInput();
            //untuk kirim ke halaman cetak
            if ($detailparkir) {
                $this->informasibayarparkir = [
                    'noplat' => $detailparkir->nomor_plat,
                    'jeniskendaraanditemukan' => $detailparkir->jeniskendaraan->nama,
                    'tarifperjam' => $detailparkir->jeniskendaraan->tarif,
                    'waktumasuk' => $detailparkir->waktu_masuk,
                    'waktukeluar' => Carbon::now()->format('Y-m-d H:i:s'),
                    'lamajam' => Carbon::parse($detailparkir->waktu_masuk)->diffInHours(Carbon::parse(Carbon::now()->format('Y-m-d H:i:s'))),
                    'totalbiaya' => $detailparkir->biaya,
                    'durasi' => $detailparkir->durasi,
                ];
            }

            // // Tandai sudah bayar dan reset form

        }
    }

    /**
     * Reset input form
     */
    private function resetInput()
    {
        $this->reset([
            'nomorPlat',
            'catatan',
            'noplat',
            'jeniskendaraanditemukan',
            'tarifperjam',
            'waktumasuk',
            'waktukeluar',
            'lamajam',
            'totalbiaya'
        ]);
    }

    /**
     * Render tampilan livewire
     */
    public function render()
    {
        return view('livewire.halbayarparkir', [
            'riwayatParkir' => RiwayatParkir::whereNotNull('waktu_keluar')->get(), // Ambil semua data riwayat parkir
        ]);
    }
}
