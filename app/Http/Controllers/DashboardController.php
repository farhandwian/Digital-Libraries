<?php

namespace App\Http\Controllers;

use App\Anggota;
use App\Buku;
use App\Biblio;
use App\Koleksi;
use App\History;
use App\Transaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
    
             
        //chart berdasarkan jenis kelamin
        $jenis_kelamin =  Anggota::groupBy('jenis_kelamin')->select('jenis_kelamin',DB::raw('count(*) as total'))->get();

        //chart berdasarkan pinjam dan kembali
        $transaksi_pinjam = Transaksi::withTrashed()->groupBy('status')->select('status',DB::raw('count(*) as total'))->get();

        $riwayat=Transaksi::whereNotIn('status',['ditolak','pending','pinjam'])->count();
        $sirkulasi = Transaksi::whereNotIn('status',['kembali','terlambat','hilang'])->count();
        
        //$total_buku = Koleksi::where([['status','!=','hilang']])->count();
        

        $data = [
           'buku' => Koleksi::where([['status','!=','hilang']])->count(),
           'anggota' => Anggota::count(),
           'transaksi' => Transaksi::count(),
           'riwayat' => $riwayat,
           'jenis_kelamin' => $jenis_kelamin,
           'transaksi_pinjam' => $transaksi_pinjam,
           'sirkulasi'=>$sirkulasi
    
        ];

        // dd($buku_kategori);
        return view('dashboard',$data);

        
    }
}
