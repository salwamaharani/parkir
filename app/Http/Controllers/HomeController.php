<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Riwayatparkir;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function cetak_pdf($plat)
    {
        $parkirDitemukan = RiwayatParkir::where('nomor_plat', $plat)
            ->whereNotNull('waktu_keluar')
            ->first();
    
        if (!$parkirDitemukan) {
            abort(404, 'Data parkir tidak ditemukan');
        }
    
        // Menghitung lama parkir
        $waktuMasuk = Carbon::parse($parkirDitemukan->waktu_masuk);
        $waktuKeluar = Carbon::now(); // Waktu keluar adalah waktu sekarang
    
        // Menghitung durasi dalam menit
        $durasiMenit = $waktuMasuk->diffInMinutes($waktuKeluar);
        
        // Menghitung hari, jam, dan menit
        $durasiHari = floor($durasiMenit / (24 * 60)); // Menghitung hari
        $sisaMenit = $durasiMenit % (24 * 60); // Sisa menit setelah mengurangi hari
        $durasiJam = floor($sisaMenit / 60); // Menghitung jam
        $durasiMenit = $sisaMenit % 60; // Sisa menit
    
        // Tarif per jam
        $tarifPerJam = $parkirDitemukan->jeniskendaraan->tarif;
    
        // Jika durasi parkir kurang dari 1 jam, biaya tetap sesuai tarif per jam
        $totalBiaya = ($durasiHari > 0 || $durasiJam > 0 ? ($durasiHari * 24 + $durasiJam) * $tarifPerJam : $tarifPerJam);
    
        // Menyiapkan data untuk view PDF
        $detailParkir = [
            'noplat' => $parkirDitemukan->nomor_plat,
            'jeniskendaraanditemukan' => $parkirDitemukan->jeniskendaraan->nama,
            'tarifperjam' => $tarifPerJam,
            'waktumasuk' => $waktuMasuk->format('Y-m-d H:i:s'),
            'waktukeluar' => $waktuKeluar->format('Y-m-d H:i:s'),
            'durasi' => sprintf("%d Hari %d Jam %d Menit", $durasiHari, $durasiJam, $durasiMenit),
            'totalbiaya' => $totalBiaya,
            'tempatparkir' => 'Parkir Pusat Sukses',
            'deskripsi' => 'Jl. Raya Sukamaju No.45, Bogor, Jawa Barat. (0251) 1234567'
        ];
    
        // Menentukan ukuran kertas A5 (148mm x 210mm)
        $pdf = PDF::loadView('cetak', ['detailparkir' => $detailParkir])
            ->setPaper('A5', 'portrait'); // Ukuran kertas A5, orientasi portrait
    
        return $pdf->stream('invoice_parkir_' . $plat . '.pdf');
    }
}