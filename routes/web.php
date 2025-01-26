<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Riwayatparkir;
use Carbon\Carbon;
use App\Http\Controllers\HomeController;

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
        $parkirDitemukan = RiwayatParkir::where('nomor_plat', $plat)->whereNotNull('waktu_keluar')->first();
        $detailparkir = [];

        if ($parkirDitemukan) {
            $detailparkir = [
                'noplat' => $parkirDitemukan->nomor_plat,
                'jeniskendaraanditemukan' => $parkirDitemukan->jeniskendaraan->nama,
                'tarifperjam' => $parkirDitemukan->jeniskendaraan->tarif,
                'waktumasuk' => $parkirDitemukan->waktu_masuk,
                'waktukeluar' => Carbon::now()->format('Y-m-d H:i:s'),
                'lamajam' => Carbon::parse($parkirDitemukan->waktu_masuk)->diffInHours(Carbon::parse(Carbon::now()->format('Y-m-d H:i:s'))),
            ];
        } else {
            abort(404);
        }
        // return view('cetak', ['detailparkir' => $detailparkir]);
        $pdf = PDF::loadView('cetak', ['detailparkir' => $detailparkir]);
        return $pdf->stream('invoice.pdf');
    }
}